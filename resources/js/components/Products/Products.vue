<template>
    <div>
       <div class="content">
			<div class="container-fluid">

				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Products 
						<router-link :to="{ name: 'create-product'}">
							<Button><Icon type="md-add" /> Create Product</Button>
						</router-link>					
					</p>				
					<div class="_overflow _table_div">
							<table class="_table">
									<!-- TABLE TITLE -->
									<tr>
										<th>ID</th>
										<th>Product Name</th>
										<th>Product Price</th>
										<th>Currency</th>
										<th>Status</th>
										<th>Created Time</th>
										<th>Action</th>
									</tr>
									<!-- TABLE TITLE -->


									<!-- ITEMS -->
								<tr v-if="isLoading">
									<td colspan="7" class="text-center">
										<Button loading shape="circle"></Button>
									</td>
								</tr>

								<template v-else>
									<tr v-if="!products.length">
										<td colspan="7" class="text-center">No Result</td>
									</tr>
									<tr v-else v-for="(product, i) in products" :key="i">
										<td>{{ product.id }}</td>
										<td class="">{{ product.name }}</td>								
										<td class="">{{ product.price }}</td>						
										<td class="">{{ product.currency }}</td>					
										<td class="">{{ product.status }}</td>									
										<td class="">{{ product.created_time_format }}</td>								
										<td>
											<button class="_btn _action_btn view_btn1" type="button">View</button>
											<button class="_btn _action_btn make_btn1" type="button">Delete</button>
										</td>
									</tr>
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
			products  : [],
			isLoading : false,
			isDisabled: false,
			pagination: [],
			page      : 1
		}
	},
	mounted() {
		this.getAll();
	},
	methods : {
		async getAll(page = 1) {
			try {
				this.isLoading = true;

				let params = {
					'page' : page
				};

				const queryString = new URLSearchParams(params).toString();
				const rsp         = await this.callApi('get', `api/product?${queryString}`);
				console.log(rsp);
				if (rsp.success) {
					this.products 	= rsp.data;							
					this.pagination = rsp.pagination;
				} else {
					this.error(rsp.data.message || 'Failed to fetch products.');
				} 
			} catch (error) {
				this.error('Unable to fetch products. Please check the server.');
			} finally {
				this.isLoading = false;
			}
		},
	}
}
</script>