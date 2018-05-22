<template>
    <div class="card bg-dark people" :class="{animated: true, shake: shaking}">
        <table>
            <tr>
                <td>
                    <img :src="avatar" class="rounded-circle">
                </td>
                <td>
                    <p class="name">{{name}}</p>
                    <small class="handle">{{username}}</small>
                </td>
            </tr>
        </table>
        
        <ul class="task">
            <li v-for="activity in activities" :key="activity.id">
                {{activity.action}} <span class="yellow">({{activity.task.id}})</span>
                <span class="pull-right cyan overflow">{{reduceStringLength(formatTime(activity.created_at), 20)}}&nbsp;&nbsp;</span>
            </li>
        </ul>
    </div>
</template>

<script>
import moment from 'moment'
var current;
    export default {
        ready(){
            current = this;
        },

        mounted() {
            
            this.name = this.pname;
            this.id = this.pid
            this.username = this.pusername.length == 0 ? '': "@"+this.pusername;
            this.listen();    
            this.fetchLog();
        },

        props: ['pname', 'pusername', 'pid'],

        data(){
            return {
                reply: '',
                name: '',
                id: 0,
                username: '',
                avatar: '/images/user.png',
                activities: [],
                shaking: false,
                transition: '',
            }
        },

        methods: {
            listen(){
                Echo.channel(this.pusername)
                    .listen('TaskUpdate', event => {
                        this.activities.unshift(event.log);
                        let length = this.activities.length; 
                        for(var i = 0; i < length; i++){
                            if(this.activities.length > 3){
                                this.activities.pop();
                            }
                        }
                        this.avatar = event.user.avatar == null ? '/images/user.png' : event.user.avatar;
                        this.shaking = true;
                        var self = this;
                        setTimeout(function(){
                            self.shaking = false;
                         }, 2000);
                    });
            },

            fetchLog(){
                axios.get('/api/v1/log/'+this.id)
                    .then(response =>{
                        this.activities = response.data.data;
                        this.avatar = response.data.data[0].user.avatar == null ? '/images/user.png' : response.data.data[0].user.avatar;
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

            formatTime(date){
                return moment(date).fromNow();
            },

            reduceStringLength(str, length){
                if(str.length > length){
                    return str.substring(0,length)+"..";
                }else{
                    return str;
                }
            }
        }
    }
</script>

<style>
    li{
        list-style: none;
        font-size: 11px;
    }
    .task{
        padding-left: 7px;
    }
    .cyan{
        color: #90e1f3;
    }

    .overflow{
        /* width: 40px; */
        overflow: ellipsis;
    }
</style>