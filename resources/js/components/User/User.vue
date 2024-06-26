<template>
    <div>
        <h1>Dashboard</h1>
        <button @click="changeParentText">Click</button>
        <Button :title="title" @handleChange="changeText"/>
        <listUser :listUser="listUser" v-on:handDelete="handleDeleteId"/>
    </div>
</template>

<script>
    import Button from '../Generate/Button';
    import listUser from '../Generate/ListUser';

    export default {
        name: "User",
        components: {
            Button, listUser
        },
        data() {
            return {
                title: 'Data Parent',
                listUser : [
                    {id : 1 , name : 'test 1'},
                    {id : 2 , name : 'test 2'},
                    {id : 3 , name : 'test 3'},
                    {id : 4 , name : 'test 4'},
                    {id : 5 , name : 'test 5'},
                ]
            }
        },
        methods: {
            changeText(data) {
                this.title = data.title;
            },
            changeParentText() {
                this.title = 'Data Parent';
            },
            handleDeleteId(id) {
                console.log('Get id from component list user' + id);
            }
        }
    }
</script>

<style scoped>
</style>
