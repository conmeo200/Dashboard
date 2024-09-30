<template>
    <p>Selected page: {{page}}</p>
    <ul>
        <li v-for="(record, index) of records" :key="index">{{record}}</li>
    </ul>
    <div :records="recordsLength" :page="page" :per-page="perPage" @paginate="getPage"></div>
</template>

<script>
    export default {
        name: "Paginate",
        props : {
          page : {
              default:1
          },
          perPage : {
              default:20
          },
          records : {
              default:[]
          },
           recordsLength : {
              default: 500
          },
        },
        // data() {
        //     return {
        //         page          : 1,
        //         perPage       : 20,
        //         records       : [],
        //         recordsLength : 0
        //     }
        // },
        methods: {
            getPage: function(page) {
                console.log(this.records);
                this.records     = [];
                const startIndex = this.perPage * (page - 1) + 1;
                const endIndex   = startIndex + this.perPage - 1;

                for (let i = startIndex; i <= endIndex; i++) {
                    this.records.push(`Item ${i}`);
                }
            },
            // getRecordsLength() {
            //     this.recordsLength = 500;
            // }
        },
        created() {
            //this.getRecordsLength();
            this.getPage(this.page);
        }
    }
</script>

<style scoped>
    [v-cloak] {
        display: none;
    }
</style>
