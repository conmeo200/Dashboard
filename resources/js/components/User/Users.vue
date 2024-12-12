<template>
    <div>
       <div class="content">
			<div class="container-fluid">

				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Users 
						<router-link :to="{ name: 'create-user'}">
							<Button><Icon type="md-add" /> Create User</Button>
						</router-link>
												
					</p>				
					<div class="_overflow _table_div">
							<table class="_table">
									<!-- TABLE TITLE -->
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Create</th>
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
									<tr v-if="!users.length">
										<td colspan="6" class="text-center">No Result</td>
									</tr>
									<tr v-else v-for="(user, i) in users" :key="i">
										<td>{{ user.id }}</td>
										<td class="">{{ user.name }}</td>									
										<td class="">{{ user.email }}</td>	
										<td>{{ user.userType }}</td>									
										<td>
											<Button :type="user.isActive === 'Y' ? 'success' : 'error'">{{ user.isActive }}</Button>
										</td>																											
										<td class="">{{ user.created_at }}</td>
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
			users     : [],
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
				const rsp         = await this.callApi('get', `api/user?${queryString}`);
				//console.log(rsp, queryString); return;
				if (rsp.success) {
					this.users 		= rsp.data || [];							
					this.pagination = rsp.pagination;
				} else {
					this.users 		= [];
					this.error(rsp.data.message || 'Failed to fetch users.');
				} 
			} catch (error) {
				this.error('Unable to fetch users. Please check the server.');
			} finally {
				this.isLoading = false;
			}
		},
	}
}
</script>