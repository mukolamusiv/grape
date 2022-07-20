<template>
    <label>
<!--        <audio controls id="myAudio" autoplay loop  hidden>-->
<!--            <source src="assets/media/SweetHome.mp3">-->
<!--        </audio>-->
        <button v-if="!play"
            class="btn btn-primary btn-sm" @click.prevent="playSound('assets/media/SweetHome.mp3')">
            Включити музику!
        </button>
    </label>

    <h1 v-if="play">Музика грає</h1>
</template>

<script>
export default {
    name: "PlayerCard",
    data() {
        return {
            text: null,
            play: false
        }
    },
    methods: {
        playSound(sound) {
            if (sound) {
                var audio = new Audio(sound);
                audio.autoplay = true;
                //audio.muted = true;
                audio.loop = true;
                audio.play();
                this.play = true;
            }
        },
    },
    mounted() {
        //setTimeout(20);
        //this.playSound("assets/media/SweetHome.mp3");
        console.log('play');
        // if(!this.play){
        // }else {
        //
        // }
        // var audio = new Audio(assets/media/SweetHome.mp3);
        // audio.play();
        //this.playSound('assets/media/SweetHome.mp3');
    },
}
</script>

<style scoped>

</style>
