<template>
    <div id="list" class="container">

        <input id="filter" name="filter" type="text" placeholder="filter with name"/>
        <ul id="counterslist">
            <li v-for="item in allcounters">
                {{ item.name }} ; {{ item.place }} ;
                <input type="date" placeholder="enter date"/>
                <button style="" :id="item.modelid" v-on:click="download(item.name, item.modelid)">Download file</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "list",
        props: {
            counters: Array,
        },
        data() {
            return {
                allcounters: this.counters,
            }
        },
        methods:{

            download: function (name,id) {

                alert("download of  "+name+"started");
            }
        },

    }
</script>

<style scoped>

    #list{

        margin-top: 30px;
    }
    button {
        background-color: cornflowerblue; /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
    }

</style>