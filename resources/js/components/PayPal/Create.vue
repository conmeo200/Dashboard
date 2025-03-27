<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Create Payment</p>

                    <form @submit.prevent="handleSubmit">
                        <div class="_input_field">
                            <Input type="text"  placeholder="Amount" v-model="payment.total"/>
                        </div>

                        <div class="_input_field">
                            <Select v-model="payment.currency" style="width:200px">
                                <Option v-for="item in cityList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                            </Select>
                        </div>

                        <div class="_input_field">
                            <Input v-model="payment.description" type="textarea" :rows="4" placeholder="Description" />    
                        </div>
                    
                        <div class="_input_field">
                            <button type="submit">Submit</button>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    data(){
        return {
            payment: {
                total      : 0,
                currency    : 'USD',
                description : ''
            }, 
            cityList: [
                    {
                        value: 'USD',
                        label: 'USD'
                    },
                    {
                        value: 'CAD',
                        label: 'CAD'
                    }
            ],
        }
    },
    methods : {
		async handleSubmit() {
            console.log(this.payment);

            try {
                const response = await this.callApi('post', 'api/paypal/create-payment', this.payment);
                let dataRespone = response.data;

                if (!dataRespone) {
                    console.log("Invalid Data");return;
                }

                window.location.href = dataRespone.approval_url

                //console.log('Response:', dataRespone.approval_url);
            } catch (error) {                
                console.error('Error:', error.response ? error.response.data : error.message);
            }
        }
	}
}
</script>


<style scoped>


</style>