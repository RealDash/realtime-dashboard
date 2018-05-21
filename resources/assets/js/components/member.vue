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
        <ul>
            <li v-for="activity in activities" :key="activity">
                {{activity}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        ready(){
            
        },

        mounted() {
            this.name = this.pname;
            this.username = this.pusername.length == 0 ? '': "@"+this.pusername;
            this.listen();    
        },

        props: ['pname', 'pusername'],

        data(){
            return {
                reply: '',
                name: '',
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
                        this.activities.push(event.activity);
                        this.avatar = event.user.avatar == null ? '/images/user.png' : event.user.avatar;
                        this.shaking = true;
                    });
            },
        }
    }
</script>

<style>
    li{
        list-style: none;
        font-size: 11px;
    }

</style>