<template>
    <div>
       <div class="content">
			<div class="container-fluid">

				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Orders 
						<Button><Icon type="md-add" /> Create Order</Button>						
					</p>				
					<div class="_overflow _table_div">
							<table class="_table">
									<!-- TABLE TITLE -->
									<tr>
										<th>ID</th>
										<th>Created Time</th>
										<th>Product Name</th>
										<th>Product Price</th>
										<th>Total</th>
										<th>Request By</th>
										<th>Action</th>
									</tr>
									<!-- TABLE TITLE -->


									<!-- ITEMS -->
								<tr v-if="isLoading">
									<td colspan="6" class="text-center">
										<Button loading shape="circle"></Button>
									</td>
								</tr>

								<template v-else>
									<tr v-if="!orders.length">
										<td colspan="6" class="text-center">No Result</td>
									</tr>
									<!-- <tr v-else v-for="(blog, i) in orders" :key="i">
										<td>{{ blog.id }}</td>
										<td class="">{{ blog.title }}</td>
										<td> 
											<div v-if="blog.categories && blog.categories.length">
												<span v-for="(c, j) in blog.categories" :key="j">
													<Tag type="border">{{ c.name }}</Tag>
												</span>
											</div>
											<div v-else></div>
										</td>
										<td>
											<div v-if="blog.tag && blog.tag.length">
												<span v-for="(c, j) in blog.tag" :key="j">
													<Tag type="border">{{ c.name }}</Tag>
												</span>
											</div>
											<div v-else></div>
										</td>
										<td>{{ blog.views }}</td>										
										<td>
											<button class="_btn _action_btn view_btn1" type="button">View</button>
											<button class="_btn _action_btn make_btn1" type="button">Delete</button>
										</td>
									</tr> -->
								</template>

									<!-- ITEMS -->
							</table>
						</div>
				</div>
				<Paginate :pagination="pagination" @page-changed="getAll"/>
			</div>
		</div>
    </div>
</template>


<script>

import Paginate from '../Generate/Paginate.vue';

export default {
	components: {Paginate},
	data(){
		return {			
			isAdding  : false,
			orders     : [],
			isLoading : false,
			isDisabled: false,
			pagination: [],
			page      : 1,
			sorted	  : 'blog_created_list'
		}
	},
	mounted() {
		this.getAll();
	},
	methods : {
		async getAll(page = 1, sorted = 'blog_created_list') {
			try {
				this.isLoading = true;

				let params = {
					'sort' : sorted,
					'page' : page
				};

				const queryString = new URLSearchParams(params).toString();
				const rsp         = await this.callApi('get', `api/order?${queryString}`);
				//console.log(rsp, queryString); return;
				if (rsp.success) {
					this.orders 		= rsp.data || [];							
					this.pagination = rsp.pagination;
				} else {
					this.orders 		= [];		
					this.error(rsp.data.message || 'Failed to fetch orders.');
				} 
			} catch (error) {
				this.error('Unable to fetch orders. Please check the server.');
			} finally {
				this.isLoading = false;
			}
		},
	}
}
</script>