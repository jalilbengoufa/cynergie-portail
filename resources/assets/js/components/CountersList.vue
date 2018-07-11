<template>
    <div id="list" class="container">

        <input id="filter" name="filter" v-model="filtername" type="text" v-on:keyup="filter()"
               placeholder="filter with name"/>
        <ul id="counterslist">
            <li v-for="item in allcounters">
                {{ item.name }} ; {{ item.place }} ;
                <input type="date" placeholder="enter date"/>
                <a :href="csvlink" :download="downloadname">Download link</a>
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
            metricsurl: String,
        },
        data() {
            return {
                allcounters: this.counters,
                filtername: "",
                csvlink: "",
                downloadname: "",
                json: "",
            }
        },
        methods: {

            download: function (name, id) {

                var self = this;
                axios.get(self.metricsurl + "/?counter=" + name + "&date=06-04-12")
                    .then(response => {
                        //console.log(response.data)

                        self.json = response.data;
                        self.convertTocsv()
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });


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
            },
            convertTocsv: function (filename) {

                var self = this;
                var arrData = typeof self.json != 'object' ? JSON.parse(self.json) : self.json;
                var CSV = '';

                for (var i = 0; i < arrData.length; i++) {
                    var row = "";

                    for (var index in arrData[i]) {

                        if (index === "time") {
                            row += arrData[i][index];
                        } else {
                            row += arrData[i][index] + ',';
                        }

                    }

                    row.slice(0, row.length - 1);
                    CSV += row + ';';
                }

                if (CSV == '') {
                    alert("Invalid data");
                    return;
                }

                self.csvlink = 'data:text/csv;charset=utf-8,' + CSV;
                ;
                self.downloadname = filename + ".csv";

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