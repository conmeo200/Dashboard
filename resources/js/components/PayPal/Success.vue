<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <h1>Payment Success</h1>
                    <p>{{ paymentID }}</p>
                    <h1>{{ payerId }}</h1>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- http://localhost.nginx/payment-success?paymentId=PAYID-M7OQRWY09A73549NG9154525&token=EC-6SN094607T639920P&PayerID=NG35XYG8LEXUA -->
<script>
export default {
    data(){
        return {
            paymentID: this.$route.query.paymentId,
            payerId: this.$route.query.PayerID
        }
    },

    methods: {

    }
}
</script>


<style scoped>


</style>