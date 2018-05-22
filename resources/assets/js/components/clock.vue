<template>
    <div class="c100">
        <div class="card bg-dark music">
            <div class="text-center">
                <br>
                <span class="time yellow">{{time}}</span>
                <br>
                <span class="date yellow">{{date}}</span>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
var curr;
    export default {
        mounted() {
            this.getTime();
            curr = this;
        },

        data(){
            return {
                date: '',
                time: '',
                raw_date: '',
            }
        },

        methods: {
            getTime(){
                axios.get('/api/v1/date')
                    .then(response =>{
                        this.raw_date = response.data.data;
                        this.date = moment(response.data).format('DD-MM-YYYY');
                        this.time = moment(response.data).format('HH:mm:ss');
                        this.controlTime();
                    })
                    .catch(error =>{

                    });
            },

            controlTime(){
                setInterval(function(){ 
                    curr.raw_date = moment(curr.raw_Date).add(1, 's');
                    curr.time = curr.raw_date.format('HH:mm:ss');
                 }, 1000);
                
            },

            formatTime(date){
                return moment(date).fromNow();
            }
        }
    }
</script>
