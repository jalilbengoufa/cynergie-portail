<template>
    <div id="list" class="container">
        <input id="filter" name="filter" v-model="filtername" type="text" v-on:keyup="filter()"
               placeholder="filter with name"/>
        <ul id="counterslist">
            <li v-for="counter in countersInfo" :key="counter.index">
                {{ counter.name }} ; {{ counter.place }} ;
                <input type="date" placeholder="enter date"/>
                <button style="" :id="counter.index" v-on:click="download(counter.place, counter.index)">Generate file</button>
                <a :href="counter.csvlink" :download="counter.filenamecsv" v-if="counter.filenamecsv!==''" >CSV</a>
                <a :href="counter.jsonlink" :download="counter.filenamejson" v-if="counter.filenamecsv!==''" >JSON</a>
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

                filtername: "",
                countersInfo:[],
            }
        },
        async created() {
            var self = this;
            var i;
            for (i = 0; i < self.counters.length; i++) {
                var counter = { index: i, name: self.counters[i].name, place: self.counters[i].place, json:"",jsonlink: "", csvlink: "",filenamecsv:"",filenamejson:""};
                self.countersInfo.push(counter);
            }

        },
        methods: {

            download: function (name, index) {

                var self = this;
                axios.get(self.metricsurl + "/?counter=" + name + "&date=06-04-12")
                    .then(response => {
                        self.countersInfo[index].json = response.data;
                        self.countersInfo[index].jsonlink = "data:text/json;charset=utf-8,"+self.countersInfo[index].json;
                        self.countersInfo[index].filenamejson = name +"-"+new Date().toLocaleTimeString()+".json";
                        self.convertTocsv(name,index)
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
            convertTocsv: function (name,id) {

                var self = this;
                var arrData = typeof self.countersInfo[id].json !== 'object' ? JSON.parse(self.countersInfo[id].json) :self.countersInfo[id].json;
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

                self.countersInfo[id].csvlink = 'data:text/csv;charset=utf-8,' + CSV;
                self.countersInfo[id].filenamecsv = name +"-"+new Date().toLocaleTimeString()+ ".csv";

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