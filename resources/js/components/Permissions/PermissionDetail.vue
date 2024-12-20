<template>
    <div>
        <div class="content">
            <Breadcrumb></Breadcrumb>
            <div class="container-fluid">
                <!--~~~~~~~ INFO USER ~~~~~~~~~-->
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Info User</p>

                    <div class="_input_field">
                        <Input type="text"  placeholder="Name" />
                    </div>

                    <div class="_input_field">
                        <Input type="email"  placeholder="Email" />
                    </div>

                    <div class="_input_field">
                        <Input type="text"  placeholder="Create At" />
                    </div>

                    <div class="_input_field">
                        <Select  filterable multiple placeholder="Select Role">
                            <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                        </Select>
                    </div>                
                
                    <div class="_input_field">
                        <Button>Update</Button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!--~~~~~~~ INFO USER ~~~~~~~~~-->
                <Tabs type="card">
                    <TabPane label="Activity">
                        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                            <p class="_title0">Activity</p>

                            <div class="_input_field">
                                <Input type="text"  placeholder="Name" />
                            </div>

                            <div class="_input_field">
                                <Input type="email"  placeholder="Email" />
                            </div>

                            <div class="_input_field">
                                <Input type="password"  placeholder="Password" />
                            </div>

                            <div class="_input_field">
                                <Select  filterable multiple placeholder="Select Role">
                                    <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                                </Select>
                            </div>                
                        
                            <div class="_input_field">
                                <Button>Update</Button>
                            </div>
                        </div>
                    </TabPane>
                    <TabPane label="Transactions">
                        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                            <p class="_title0">Transactions</p>

                            <div class="_input_field">
                                <Input type="text"  placeholder="Name" />
                            </div>

                            <div class="_input_field">
                                <Input type="email"  placeholder="Email" />
                            </div>

                            <div class="_input_field">
                                <Input type="password"  placeholder="Password" />
                            </div>

                            <div class="_input_field">
                                <Select  filterable multiple placeholder="Select Role">
                                    <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                                </Select>
                            </div>                
                        
                            <div class="_input_field">
                                <Button>Update</Button>
                            </div>
                        </div>
                    </TabPane>
                    <TabPane label="Products">
                        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                            <p class="_title0">Products</p>

                            <div class="_input_field">
                                <Input type="text"  placeholder="Name" />
                            </div>

                            <div class="_input_field">
                                <Input type="email"  placeholder="Email" />
                            </div>

                            <div class="_input_field">
                                <Input type="password"  placeholder="Password" />
                            </div>

                            <div class="_input_field">
                                <Select  filterable multiple placeholder="Select Role">
                                    <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                                </Select>
                            </div>                
                        
                            <div class="_input_field">
                                <Button>Update</Button>
                            </div>
                        </div>
                    </TabPane>
                    <TabPane label="Orders">
                        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                            <p class="_title0">Orders</p>

                            <div class="_input_field">
                                <Input type="text"  placeholder="Name" />
                            </div>

                            <div class="_input_field">
                                <Input type="email"  placeholder="Email" />
                            </div>

                            <div class="_input_field">
                                <Input type="password"  placeholder="Password" />
                            </div>

                            <div class="_input_field">
                                <Select  filterable multiple placeholder="Select Role">
                                    <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                                </Select>
                            </div>                
                        
                            <div class="_input_field">
                                <Button>Update</Button>
                            </div>
                        </div>
                    </TabPane>
                </Tabs>
            </div>
        </div>
    </div>
</template>


<script>

import Breadcrumb from '../Generate/Breadcrumb.vue';

export default {
    components: {Breadcrumb},
    data(){
        return {
    
        }
    },

    methods: {
    }
}
</script>


<style scoped>


</style>