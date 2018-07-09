<template>
    <div id="list" class="container">

        <input id="filter" name="filter" v-model="filtername" type="text" v-on:keyup="filter()"
               placeholder="filter with name"/>
        <ul id="counterslist">
            <li v-for="item in allcounters">
                {{ item.name }} ; {{ item.place }} ;
                <input type="date" placeholder="enter date"/>
                <button style="" :id="item.modelid" v-on:click="download(item.name, item.modelid)">Download file
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "list",
        props: {
            counters: Array,
            filterurl: String,
        },
        data() {
            return {
                allcounters: this.counters,
                filtername: "",
            }
        },
        methods: {

            download: function (name, id) {

                alert("download of  " + name + "started");
            },
            filter: function () {
                var self = this;
                axios.get(self.filterurl,
                    {
                        params:
                            {
                                filter: self.filtername
                            }
                    })
                    .then(response => {
                        console.log(response.data)
                        self.allcounters = response.data;

                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            }
        },

    }
</script>

<style scoped>

    #list {

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