<template>
    <div class="card bg-dark music text-center" :class="{animated: true, shake: shaking}">
        <img :src="current_artist_image" class="img-responsive rounded-circle center-block" style="padding-top: 15px;" width="90px" height="90px">
        <span class="music-title">{{current_music_name}}
            <small>{{current_artist_name}}</small>
            <p>
                <i class="fa fa-music"></i>
                &nbsp;
                <i @click="previousSong(previous)" class="fa fa-fast-backward yellow media-icons"></i>
                &nbsp;
                <i v-show="!playing" v-if="musics.length > 0" :disabled="disabled" @click="playMusic(current_music)" class="fa fa-play yellow media-icons"></i>
                <i v-show="!playing" v-if="musics.length == 0" class="fa fa-play"></i>
                
                <i v-show="playing" @click="pauseMusic()" class="fa fa-pause yellow media-icons"></i>
                &nbsp;
                <i @click="nextSong(next)" class="fa fa-fast-forward yellow media-icons"></i>
            </p>
        </span>
    </div>
</template>


<script>
    export default {
        mounted() {
            this.fetchMusics();
            this.listen();
            this.audio = new Audio();
        },

        data(){
            return {
                audio: null,
                musics: [],
                disabled: false,
                playing: false,
                next: 0,
                shaking: false,
                previous: 1000,
                current_music: 0,
                current_music_name: "No music",
                current_artist_name: "None",
                current_artist_image: "/images/user.png",

            }
        },

        methods: {

            listen(){
                Echo.channel('current-music')
                    .listen('CurrentMusic', event => {
                        this.current_music = parseInt(event.index);
                        this.shaking = true;
                        var self = this;
                        self.playMusic(this.current_music);
                        Event.$emit('added-to-playlist');
                        setTimeout(function(){
                            self.shaking = false;
                         }, 2000);
                    });
                
                Echo.channel('added-music')
                    .listen('AddedMusic', event => {
                        this.fetchMusics();
                        this.shaking = true;
                        var self = this;
                        setTimeout(function(){
                            self.shaking = false;
                         }, 2000);
                    });
            },
            
            fetchMusics(){
                axios.get('/api/v1/musics')
                    .then(response =>{
                        this.musics = response.data.data; 
                        if(this.musics.length == 0){
                            this.disabled = true;
                        }
                    })
                    .catch(error =>{

                    });
            },

            playMusic(index) {
                let music = this.musics[index];
                console.log(music);
                this.audio.pause();
                this.audio.src = '/music/' + music.file_name
                this.next = index >= this.musics.length - 1 ? 0 : index + 1;
                this.previous = index <= 0 ? this.musics.length - 1 : index - 1;
                var self = this;
                this.audio.play().
                    then(
                        
                        this.audio.onplaying = function() {
                            self.playing = true;
                            self.current_artist_name = music.artist.artist_name;
                            self.current_music_name = music.music_title;
                            let image_url = music.artist.avatar;
                            self.current_artist_image = (image_url == null || image_url == '') ? '/images/user.png' :'/artists/img/'+music.artist.avatar;
                        },

                        this.audio.onended = function() {
                            self.nextSong(self.next);

                        }
                    )
            },

            nextSong(index) {
                
                this.playMusic(index);
            },

            previousSong(index) {
                this.playMusic(index);
            },

            pauseMusic(){
                this.audio.pause();
                this.playing = false;
            },

            unPauseMusic(){
                this.audio.play();
            }
        }
    }
</script>

<style scoped>
    .media-icons:hover{
        cursor: pointer;
    }
</style>
