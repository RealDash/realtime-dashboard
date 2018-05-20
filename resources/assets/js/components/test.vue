<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button @click="emitEvent()">emit</button>
                {{ip}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            Echo.channel('task-update')
                .listen('TaskUpdate', event => {
                    console.log(event);
                    this.ip = event.ip_address;
                });
        },

        data(){
            return {
                ip: 'nothing yet',
            }
        },

        methods: {
            emitEvent(){
                axios.get('/emit')
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {

                    });
            }
        }
    }
</script>
