<template>
    <div class="card bg-dark upcoming">
        <h6 class="text-center title">Upcoming Events &nbsp;<i class="fa fa-calendar white"></i></h6>
        <p class="divider"></p>
        <div class="text-center" v-for="event in events" :key="event.id">
            <div>{{event.title}}</div>
            <span class="cyan overflow tiny">{{event.start_at}} | {{event.end_at}}</span>
            <p class="divider">&nbsp;</p>
        </div>
        
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchEvents();
        },

        data(){
            return {
                events: []
            }
        },

        methods: {
            fetchEvents(){
                axios.get('/api/v1/events')
                    .then(response =>{
                        this.events = response.data.data;
                        let length = this.activities.length; 
                        for(var i = 0; i < length; i++){
                            if(this.activities.length > 3){
                                this.activities.pop();
                            }
                        }
                        
                    })
                    .catch(error =>{

                    });
            },

            
        }
    }
</script>

<style>
.tiny{
    font-size: 12px;
}

.divider{
    
}
</style>
