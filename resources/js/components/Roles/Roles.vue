<template>
    <div>
       <div class="content">
			<div class="container-fluid">

				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Roles
						<router-link :to="{ name: 'create-role'}">
							<Button><Icon type="md-add" /> Create role</Button>
						</router-link>
												
					</p>				
					<div class="_overflow _table_div">
							<table class="_table">
									<!-- TABLE TITLE -->
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Guard Name</th>										
										<th>Action</th>
									</tr>
									<!-- TABLE TITLE -->


									<!-- ITEMS -->
								<tr v-if="isLoading">
									<td colspan="4" class="text-center">
										<Button loading shape="circle"></Button>
									</td>
								</tr>

								<template v-else>
									<tr v-if="!roles.length">
										<td colspan="6" class="text-center">No Result</td>
									</tr>
									<tr v-else v-for="(role, i) in roles" :key="i">
										<td>{{ role.id }}</td>
										<td class="">{{ role.name }}</td>									
										<td class="">{{ role.guard_name }}</td>											
										<td>
											<router-link :to="{ name: 'role-detail', params: { id: role.id }}">
												<button class="_btn _action_btn view_btn1" type="button">View</button>
											</router-link>
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
			roles     : [],
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
				const rsp = await this.callApi('get', `api/role?${queryString}`);
				
				if (rsp.success) {
					this.roles 		= rsp.data || [];							
					this.pagination = rsp.pagination;
				} else {
					this.roles 		= [];
					this.error(rsp.data.message || 'Failed to fetch roles.');
				} 
			} catch (error) {
				this.error('Unable to fetch roles. Please check the server.');
			} finally {
				this.isLoading = false;
			}
		}
	}
}
</script>