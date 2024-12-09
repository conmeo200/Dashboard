	<template>
		<div>
		<div class="content">
				<div class="container-fluid">
					<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
					<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
						<p class="_title0">Tags <Button @click="addModal = true"><Icon type="md-add" /> Add tag</Button></p>


						<div class="_overflow _table_div">
							<table class="_table">
									<!-- TABLE TITLE -->
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Is Active</th>
									<th>Create At</th>
									<th>Update At</th>
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
									<tr v-if="!tags">
										<td colspan="6" class="text-center">No Result</td>
									</tr>
									<tr v-else v-for="(tag, i) in tags" :key="i">
										<td>{{ tag.id }}</td>
										<td class="">{{ tag.name }}</td>
										<td>
											<Button :type="tag.isActive === 'Y' ? 'success' : 'error'">{{ tag.isActive }}</Button>
										</td>
										<td>{{ tag.created_time_format }}</td>
										<td>{{ tag.updated_time_format }}</td>
										<td>
											<button class="_btn _action_btn view_btn1" type="button" @click="detail(tag.id)">View</button>
											<button class="_btn _action_btn make_btn1" type="button" @click="deleteTag(tag.id)">Delete</button>
										</td>
									</tr>
								</template>

									<!-- ITEMS -->
							</table>
						</div>
					</div>
					<!-- tag adding modal -->
					<Modal
						v-model="addModal"
						title="Add tag"
						:mask-closable="false"
						:closable="false"
						>
						
						<br>
						<Input :disabled="data.id ? true : false" v-model="data.tag_name" placeholder="Add tag name"  />

						<br>
						<br>

						<RadioGroup v-model="data.is_active">
							<Radio label="Y">
								<span>Yes</span>
							</Radio>
							<Radio label="N">
								<span>No</span>
							</Radio>
						</RadioGroup>

						<template #footer>
							<Button type = "default" @click = "closeModal()">Close</Button>
							<Button 
								:loading="isLoading" 
								:type="isLoading ? '' : 'primary'" 
								:shape="isLoading ? 'circle' : ''" 
								@click="!data.id ? addTag() : updateTag(data.id)"
								>
								<template v-if="!isLoading">
									{{ !data.tag_name ? 'Add' : 'Update' }}
								</template>
							</Button>
						</template>

					</Modal>
					<!-- tag editing modal -->
					<Paginate :pagination="pagination" @page-changed="getAll"/>
				</div>
			</div>
		</div>
	</template>
	<script>

	import Paginate from '../Generate/Paginate.vue';

	export default {
			components: {Paginate},
			data() {
				return {
					addModal: false,
					data    : {
						id       : '',
						tag_name : '',
						is_active: 'Y'
					},
					isAdding  : false,
					tags      : [],
					isLoading : false,
					isDisabled: false,
					pagination: [],
					page:1
				}
			},
			mounted() {
				this.getAll();
			},
			methods: {
					// Close Modal
					closeModal() {
						this.addModal       = false;
						this.data.tag_name  = '';
						this.data.is_active = 'Y';
					},
					// Add Item			
					async addTag() {						
						this.isLoading      = true;
						let validateInputTagName  = this.validateValue('Tag Name', this.data.tag_name);
						let validateRadioisActive = this.validateValue('isActive', this.data.is_active);

						if (validateInputTagName && validateRadioisActive) {
							try {
							const rsp = await this.callApi('post', 'api/tag/create', this.data);

							if (rsp.success) {
								this.addModal = false;		
								this.tags 		= rsp.data || [];							
								this.pagination = rsp.pagination;				
								this.success(rsp.message);
							} else {
								this.error(rsp.data.message);
							}
							} catch (error) {
							console.error("API Error:", error);
							this.error("Something went wrong!");
							} finally {
							this.isLoading = false;
							}
						} else {
							this.isLoading = false;
						}
					},

					// Update Item			
					async updateTag(id) {
						this.isLoading        	  = true;
						let validateID            = this.validateParam(id);					
						let validateRadioisActive = this.validateValue('isActive', this.data.is_active);

						if (validateRadioisActive && validateID) {
							try {
								const rsp = await this.callApi('post', 'api/tag/' + id, this.data);

								if (rsp.success) {
									this.tags       = rsp.data || [];
									this.pagination = rsp.pagination;
									this.isLoading  = false;
									
									this.success(rsp.message);
								} else {
									this.error(rsp.data.message);
								}
							} catch (error) {
								console.error("API Error:", error);
								this.error("Something went wrong!");
							} finally {
								this.isLoading = false;
							}
						} else {
							this.isLoading = false;
						}
					},

					// Delete Item			
					async deleteTag(id) {
						this.isLoading = true;
						let validateID = this.validateParam(id);

						if (validateID) {
							try {
								const rsp = await this.callApi('delete', 'api/tag/' + id);

								if (rsp.success) {
									this.tags       = rsp.data || [];
									this.pagination = rsp.pagination;	
																																				
									this.success(rsp.message);
								} else {
									this.error(rsp.data.message);
								}
							} catch (error) {
								console.error("API Error:", error);
								this.error("Something went wrong!");
							} finally {
								this.isLoading = false;
							}
						} else {
							this.isLoading = false;
						}
					},

					// Get All Item
					async getAll(page = 1) {
						try {
							this.isLoading = true;
							const rsp = await this.callApi('get', `api/tag?page=${page}`);

							if (rsp.success) {
								this.tags 		= rsp.data || [];							
								this.pagination = rsp.pagination;
							} else {
								this.error(rsp.data.message || 'Failed to fetch tags.');
							} 
						} catch (error) {
							this.error('Unable to fetch tags. Please check the server.');
						} finally {
							this.isLoading = false;
						}
					},

					// Detail
					async detail(id) {
						try {
							const rsp = await this.callApi('get', 'api/tag/' + id);

							if (rsp.success == true) {
								this.addModal       = true;
								this.data.tag_name  = rsp.data.name;
								this.data.is_active = rsp.data.isActive;
								this.data.id 		= rsp.data.id;
							} else {
								this.error('Item not found. Please check the server.');
							}
						} catch (error) {
							this.error('Item not found. Please check the server.');
						}
					},
				}
			}
	</script>