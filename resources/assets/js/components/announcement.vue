<template>
    <div class="card bg-dark announcement" :class="{animated: true, shake: shaking}">
        <h6 class="text-center title">Announcements</h6>
        <div class="divider"></div>
        <div class="text-center" v-for="announcement in announcements" :key="announcement.id">
            <!-- <div class="cyan">{{announcements.subject}}</div> -->
            <br>
            <span style="font-size: 18px;">{{announcement.message}}</span>
            <p class="divider">&nbsp;</p>
        </div>
        
    </div>
</template>


<script>
    export default {

        mounted() {
            this.fetchAnnouncements();
            this.listen();
        },

        data(){
            return {
                announcements: [],
                date: '',
                shaking: false,
            }
        },

        methods: {

            listen(){
                Echo.channel('announcement-update')
                    .listen('AnnouncementUpdate', event => {
                        
                        this.shaking = true;
                        var self = this;
                        this.announcements.unshift(event.announcements);
                        setTimeout(function(){
                            self.shaking = false;
                            }, 2000);
                    });
            },

            fetchAnnouncements(){
                axios.get('/api/v1/announcements')
                    .then(response =>{
                        this.announcements = response.data.data;
                        let length = this.activities.length; 
                        
                    })
                    .catch(error =>{

                    });
            },
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

<style scoped>
    .announcement{
        overflow-y: auto;
    
    }

    .announcement::-webkit-scrollbar {
        width: 6px;
        border-radius: 0.3em;
        margin-left: 12px;
        background-color: #1f1f1f;
    }
</style>