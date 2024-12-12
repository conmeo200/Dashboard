<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Create Product</p>

                    <div class="_input_field">
                        <Input type="text"  placeholder="Name" />
                    </div>

                    <div class="_input_field">
                        <Input type="text"  placeholder="Price" />
                    </div>

                    <div class="_input_field">
                        <Select  filterable multiple placeholder="Select Currency">
                            <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                        </Select>
                    </div>  
                    
                    <div class="_input_field">
                        <Select  filterable multiple placeholder="Select User">
                            <Option v-for="(c, i) in category" :value="c.id" :key="i">{{ c.categoryName }}</Option>
                        </Select>
                    </div>  
                
                    <div class="_input_field">
                        <Button class="btn btn-primary">Add</Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
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