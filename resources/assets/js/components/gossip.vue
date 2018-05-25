<template>
   
        <div class="card bg-dark gossip" :class="{animated: true, shake: shaking}">
            <h6 class="text-center title">Gists</h6>
            <div class="divider"></div>
            <div class="gist" v-for="gist in gists" :key="gist.id">
                    {{gist.gist}}
                    <span class="status pull-right badge badge-secondary">{{gist.user.user_name}}</span>
                </div>
        </div>
    
</template>


<script>
    export default {
        mounted() {
            this.fetchGists();
            this.listen();
        },

        data(){
            return {
                gists: [],
                shaking: false,
            }
        },

        methods: {
            listen(){
                Echo.channel('gist-update')
                    .listen('GistUpdate', event => {
                        
                        this.shaking = true;
                        var self = this;
                        this.gists.unshift(event.gists);
                        setTimeout(function(){
                            self.shaking = false;
                            }, 2000);
                    });
            },

            fetchGists(){
                axios.get('/api/v1/gists')
                    .then(response =>{
                        this.gists = response.data.data; 
                    })
                    .catch(error =>{

                    });
            }
        }
    }
</script>

<style scoped>
    .gossip{
        overflow-y: auto;
        
    }

    .gossip::-webkit-scrollbar {
        width: 6px;
        border-radius: 0.3em;
        margin-left: 12px;
        background-color: #1f1f1f;
    }

    .gossip .status{
        font-size: 9px;
        margin-top: 3px;
        margin-right: 4px;
    }
    .gist{
        margin-top: 5px;
        font-size: 14px;
        margin-left: 5px;
    }
</style>