<template>
    <div class="c100">
        <div class="card bg-dark scrum-board">
            <span class="text-center title">Scrumy Board</span>
            <div class="divider"></div>
            <p></p>
            <div class="scrumy" style="margin-left: 8px; margin-right: 8px;">
                <div class="scrum" v-for="scrum in scrums" :key="scrum.id">
                    <span class="yellow">|{{scrum.id}}| </span> {{scrum.title}}
                    <span class="status pull-right badge badge-secondary">{{status[scrum.status]}}</span>
                </div>
              
            </div>
        </div>
    </div>
</template>

<script>
    export default {
         mounted() {
            this.fetchScrums();
            Event.$on('update-scrum-board', ()=> {
                this.fetchScrums();
            });
        },

        data(){
            return {
                
                scrums: [],
                status: ['Pending','Taken','Completed','Verified','Progress',],

            }
        },

        methods: {

            listen(){
                Echo.channel('added-task')
                    .listen('AddedTask', event => {
                        
                        this.current_music = parseInt(event.index);
                        this.shaking = true;
                        var self = this;
                        self.playMusic(this.current_music);
                        setTimeout(function(){
                            self.shaking = false;
                         }, 2000);
                    });
            },
            
            fetchScrums(){
                axios.get('/api/v1/scrums')
                    .then(response =>{
                        this.scrums = response.data.data;
                    })
                    .catch(error =>{

                    });
            },
        }
    }
</script>

<style scoped>
    .scrumy{
        font-size: 14px;
    }

    .scrumy{
        overflow-y: auto;
    
    }

    .scrumy::-webkit-scrollbar {
        width: 6px;
        border-radius: 0.3em;
        margin-left: 12px;
        background-color: #1f1f1f;
    }

    .scrumy .status{
        font-size: 9px;
        margin-top: 3px;
        margin-right: 4px;
    }

    .scrum{
        /* border-bottom: 0.04em solid #696969; */
        margin-top: 5px;
    }

</style>

