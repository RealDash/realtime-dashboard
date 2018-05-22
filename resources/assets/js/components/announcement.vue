<template>
    <div class="card bg-dark announcement">
        <h6 class="text-center title">Announcements</h6>
        <div class="divider"></div>
        
    </div>
</template>


<script>
    export default {

        

        mounted() {
            
        },

        props:['title'],

        data(){
            return {
                titles: this.title,
                date: '',
            }
        },

        methods: {
            getTime(){
                axios.get('/api/v1/date')
                    .then(response =>{
                        this.date = moment(response.data).format('DD MM YY');
                        
                    })
                    .catch(error =>{

                    });
            },

            formatTime(date){
                return moment(date).fromNow();
            }
        }
    }
</script>
