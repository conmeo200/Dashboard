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
								<th>Date</th>
								<th>Title</th>
								<th>Category</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr>
								<td>25-05-19</td>
								<td class="_table_name">Manhattan's art center "Shed" opening ceremony</td>
								<td>Economy</td>
								<td>
									<button class="_btn _action_btn view_btn1" type="button">View</button>
									<button class="_btn _action_btn edit_btn1" type="button">Edit</button>
									<button class="_btn _action_btn make_btn2" type="button">Make Features</button>
									<button class="_btn _action_btn make_btn3" type="button">Make Card</button>
									<button class="_btn _action_btn make_btn1" type="button">Delete</button>
								</td>
							</tr>
								<!-- ITEMS -->

								<!-- ITEMS -->
							<tr>
								<td>25-05-19</td>
								<td class="_table_name">Are Trump era is having an impact on what 's future voters</td>
								<td>Social</td>
								<td>
									<button class="_btn _action_btn view_btn1" type="button">View</button>
									<button class="_btn _action_btn edit_btn1" type="button">Edit</button>
									<button class="_btn _action_btn make_btn2" type="button">Make Features</button>
									<button class="_btn _action_btn make_btn3" type="button">Make Card</button>
									<button class="_btn _action_btn make_btn1" type="button">Delete</button>
								</td>
							</tr>
								<!-- ITEMS -->

										<!-- ITEMS -->
							<tr>
								<td>25-05-19</td>
								<td class="_table_name">Manhattan's art center "Shed" opening ceremony</td>
								<td>Economy</td>
								<td>
									<button class="_btn _action_btn view_btn1" type="button">View</button>
									<button class="_btn _action_btn edit_btn1" type="button">Edit</button>
									<button class="_btn _action_btn make_btn2" type="button">Make Features</button>
									<button class="_btn _action_btn make_btn3" type="button">Make Card</button>
									<button class="_btn _action_btn make_btn1" type="button">Delete</button>
								</td>
							</tr>
								<!-- ITEMS -->

								<!-- ITEMS -->
							<tr>
								<td>25-05-19</td>
								<td class="_table_name">Are Trump era is having an impact on what 's future voters</td>
								<td>Social</td>
								<td>
									<button class="_btn _action_btn view_btn1" type="button">View</button>
									<button class="_btn _action_btn edit_btn1" type="button">Edit</button>
									<button class="_btn _action_btn make_btn2" type="button">Make Features</button>
									<button class="_btn _action_btn make_btn3" type="button">Make Card</button>
									<button class="_btn _action_btn make_btn1" type="button">Delete</button>
								</td>
							</tr>
								<!-- ITEMS -->

								<!-- ITEMS -->
							<tr>
								<td>25-05-19</td>
								<td class="_table_name">Are Trump era is having an impact on what 's future voters</td>
								<td>Social</td>
								<td>
									<button class="_btn _action_btn view_btn1" type="button">View</button>
									<button class="_btn _action_btn edit_btn1" type="button">Edit</button>
									<button class="_btn _action_btn make_btn2" type="button">Make Features</button>
									<button class="_btn _action_btn make_btn3" type="button">Make Card</button>
									<button class="_btn _action_btn make_btn1" type="button">Delete</button>
								</td>
							</tr>
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
					<label for=""><strong>Tag Name</strong></label>
					<br>
					<Input v-model="data.tagName" placeholder="Add tag name"  />

					<br>
					<br>

					<label for=""><strong>isActive </strong></label><br>
					<RadioGroup v-model="data.isActice">
						<Radio label="Y">
							<span>Yes</span>
						</Radio>
						<Radio label="N">
							<span>No</span>
						</Radio>
					</RadioGroup>

					<template #footer>
						<Button type = "default" @click = "addModal=false">Close</Button>
						<Button type = "primary" @click = "addTag">Add</Button>
					</template>

				</Modal>
				<!-- tag editing modal -->
				 <Page :total="100" />

			</div>
		</div>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				addModal: false,
				data: {
					tagName  : '',
					isActice : ''
				}
			}
		},
		methods: {
			addTag() {
				let validateInputTagName  = this.validateValue('Tag Name', this.data.tagName);
				let validateRadioisActive = this.validateValue('isActive', this.data.isActice);

				if (validateInputTagName && validateRadioisActive) {
					return this.info('Test Notice');
				}
			}
		}
	}
</script>