<style>
    .music-list {
        position: fixed;
        top: 0;
        right: 0;
        width: 26vw;
        height: auto;
        display: flex;
        flex-direction: column;
        background: #000;
        filter: drop-shadow(2px 4px 6px #000);
        display: none;
        /* transition: all 300ms ease-in-out; */
        z-index: 99999999;
        padding: 0.5em
    }

    .music-list.fullscreen {
        width: 100%;
        height: 100%;
    }
    
    .music-list.fullscreen .previous-button, .music-list.fullscreen .next-button {
        display: none;
    }

    .music-list iframe {
        width: 100%;
        height: auto;
    }

    .music-list.fullscreen iframe {
        height: 100%;
    }

    .music-list .controls {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .music-list .controls img {
        width: 100%;
    }

    .music-list .controls button {
        width: 2em;
        height: 2em;
        padding: 0;
        background: transparent;
        border: 0;
    }

    .music-list .close-btn {
        margin-left: 0.5em;
    }

    .music-list .player {
        flex: 100%;
        display: flex;
        flex-flow: row;
        /* flex-wrap: wrap; */
        flex-basis: 100%;
        padding: 0.5em;
        height: 90%;
    }

    .music-list .previous-button, .music-list .next-button {
        color: #fff;
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;
        font-size: 1em;
        flex: 10%;
    }

    .music-list .previous-button span, .music-list .next-button span {
        margin-top: 1em;
        opacity: 0.9;
        font-size: 0.8em;
    }

    .music-list .previous-button {
        margin-right: 0.5em;
    }

    .music-list .next-button {
        margin-left: 0.5em;
    }

    .previous-button span, .next-button span {
        margin-top: 1em;
        opacity: 0.9;
        font-size: 0.8em;
        display: none;
    }

    .music-list .video-player {
        flex: 80%;
        height: 100%;
        /* overflow: auto; */
    }

    @media only screen
    and (max-width: 991px) {
        .music-list {
            width: 40vw;
        }

        .previous-button span, .next-button span { 
            display: block;
        }
    }

    /* smartphones, touchscreens */
    @media (hover: none) and (pointer: coarse) {
        .previous-button span, .next-button span { 
            display: block;
        }
    }

    /* stylus-based screens */
    @media (hover: none) and (pointer: fine) {
        .previous-button span, .next-button span { 
            display: block;
        }
    }
</style>

<template>
    <div class="music-list">
        <div class="controls">
            <button v-if="!isFullscreen" class="fullscreen-btn" @click.prevent="playFullscreen()">
                <img :src="'/front/images3D/fullscreen-btn.png'" alt="">
            </button>
            <button v-else class="exit-fullscreen-btn" @click.prevent="exitFullscreen()">
                <img :src="'/front/images3D/minimize-btn.png'" alt="">
            </button>
            <button class="close-btn" @click.prevent="closePlayer()">
                <img :src="'/front/icons/close-btn.png'" alt="">
            </button>
        </div>
        <div class="player">
            <div class="previous-button" @click="playPrevSong()" title="Previous">
                <i class="fas fa-step-backward"></i>
                <span>Prev</span>
            </div>
            <div class="video-player">
                <youtube :video-id="videoId" :player-vars="playerVars" ref="youtube" @playing="playing" @paused="pausedVideo" @ended="playNextSong()" :resize="true"></youtube>
            </div>
            <div class="next-button" @click="playNextSong()" title="Next">
                <i class="fas fa-step-forward"></i>
                <span>Next</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data:function() {
        return {
            videos: [
                {id:"SBH_u-vEK30",start:2},
                {id:"vBdGUBOs_r4",start:3},
                {id:"CzANBg56hFo",start:10},
                {id:"-LCAIUamxZ0",start:4},
                {id:"fZVi07gz28w",start:2},
                {id:"23dW3H9yFSU",start:30},
                {id:"y73i8YejSCU",start:5},
                {id:"yhv2WUUOAIQ",start:0},
                {id:"je0Q-0R3Fds",start:4},
                {id:"AmXuJn8Sw5k",start:0},
                {id:"5NpPRrlMhp0",start:0},
                {id:"X9Ag3UsGxRI",start:0},
                {id:"qoLmmbpbpMs",start:24},
                {id:"sQFEG84gOqo",start:0},
                {id:"sMVFXfoaS3w",start:0},
                {id:"fpHAsb2XQOY",start:11},
                {id:"t03EUTfxY5E",start:50},
                {id:"CIxXyJSqOXc",start:0},
                {id:"b3kBDtjRtB0",start:8},
                {id:"qXr0zVt-BxY",start:0},
                {id:"HIAOG9nhrt8",start:4},
                {id:"k_UOuSklNL4",start:0},
                {id:"2nGKqH26xlg",start:71},
                {id:"cunRWXodnv8",start:36},
                {id:"CZWyqj7gAAc",start:0},
                {id:"u7K5LTbaepQ",start:2},
                {id:"IOK8Jb76ibc",start:6},
                {id:"ibmh64itn1M",start:0},
                {id:"fPeExiJIqUc",start:3},
                {id:"ZUxn6JLwdDY",start:10},
                {id:"i4nYl8sQSd8",start:2},
                {id:"kGYqXwi4QXU",start:0},
                {id:"8DQVmWbele8",start:5},
                {id:"l9d5Rj0FGU8",start:8},
                {id:"Ubg7AI81VsQ",start:0},
                {id:"2-eclUz-RYI",start:0},
                {id:"GuanbnnzXQ4",start:0},
                {id:"Gcxv7i02lXc",start:4},
                {id:"lVChCevOy-8",start:0},
                {id:"wLAXfkK-DPg",start:5},
                {id:"Hc9fDn-Z3PQ",start:0},
                {id:"zBFvHDdh7oo",start:1},
                {id:"vNJnrcrvjTk",start:4},
                {id:"eDuZWJ5Uz2I",start:0},
                {id:"zkGzQulZSEo",start:0},
                {id:"mvRQtbqLPK8",start:4},
                {id:"rJtDlvmbL20",start:2},
                {id:"IrUbFvF8Lzk",start:3},
                {id:"DzBUzjucWu4",start:5},
                {id:"YR5USHu6D6U",start:1},
                {id:"Xwu1QxP84b4",start:11},
                {id:"Jq-DGs9rfBQ",start:0},
                {id:"XPbjk6TycMc",start:0},
                {id:"nVnqwLbltfo",start:0},
                {id:"QxHkLdQy5f0",start:0},
                {id:"jJfCI3FL9WI",start:24},
                {id:"yYKOceZLV04",start:0},
                {id:"8XsKk9Aj4MU",start:0},
                {id:"DWAJEAhrhS4",start:2},
                {id:"HUx9fOZOJKs",start:2},
                {id:"qeHkIb7VRUM",start:2},
                {id:"m50_K8P194M",start:0},
                {id:"c-HqO-EojS4",start:0},
                {id:"xRqI5R6L7ow",start:7},
                {id:"b8JOi1q5ugs",start:0},
                {id:"aKJvbTEnp0I",start:0},
                {id:"iteDBk6k3N8",start:0},
                {id:"50XWHxH4tJQ",start:4},
                {id:"4wrNFDxCRzU",start:4},
                {id:"6BX33M3ypgU",start:1},
                {id:"Wm-Tlc1DGFg",start:0},
                {id:"mDEbkme11Gg",start:2},
                {id:"tzvrMKQQbeU",start:0},
                {id:"qsNEu750zok",start:0},
                {id:"9BD1y0TOk3o",start:2},
                {id:"2X4ghUUCw7s",start:0},
                {id:"iMxOluEwfVw",start:4},
                {id:"-6QU1yJE84Y",start:0},
                {id:"jTaotgdYVQE",start:1},
                {id:"JwACh3Xs-FY",start:1},
                {id:"PEH2FtIkAus",start:6},
                {id:"WnrsWPmVzfk",start:4},
                {id:"z5gAYr5YP_0",start:2},
                {id:"jtAyJHwiq9k",start:10},
                {id:"cxFX8fyWpTM",start:13},
                {id:"FvLjbGxMkr8",start:0},
                {id:"MfxXVYS_F30",start:0},
                {id:"5WhUVvKTCic",start:0},
                {id:"wqCpjFMvz-k",start:4},
                {id:"zOvsyamoEDg",start:7},
                {id:"YiiysoWTZ8o",start:0},
                {id:"ayq0R3SexTQ",start:0},
                {id:"k5dkwQY-_tk",start:0},
                {id:"JS27Mrb4a1E",start:0},
                {id:"UpPoz2gy0Cc",start:0},
                {id:"8FfEhTBrlWc",start:1},
                {id:"vo8JYCqHozI",start:26},
                {id:"WL_EM4wSbqc",start:0},
                {id:"5C6lEyuibhM",start:2},
                {id:"AIR5XPWK3Vk",start:0},
                {id:"PFCekeoSTwg",start:6},
                {id:"_CTYymbbEL4",start:4},
                {id:"igQz3505y7s",start:0},
                {id:"Pm3PyY9Hhzc",start:8},
                {id:"3P-imA4618Y",start:0},
                {id:"865NKO3x0wk",start:11},
                {id:"aV8-a6VaSGg",start:0},
                {id:"IHMrMqz3Md8",start:1},
                {id:"3MjPO5w2Gvs",start:1},
                {id:"nHZoP16QmvA",start:4},
                {id:"3pMriPstagI",start:2},
                {id:"F8YSzILKdlk",start:1},
                {id:"VYGLHJPfits",start:0},
                {id:"n3Oagvi_UHQ",start:0},
                {id:"q1Oo9cwouTE",start:8},
                {id:"iyLdoQGBchQ",start:0},
                {id:"9EeDbIJQFMY",start:0},
                {id:"VxuDI3dS2L4",start:0},
                {id:"njBrvxYxJuw",start:2},
                {id:"DD97YL3wZ-w",start:1},
                {id:"ifpyNQn8D3Q",start:0},
                {id:"GM5ZTysD0Io",start:1},
                {id:"oDbR_TiM-zs",start:1},
                {id:"RgV3iLVS0R4",start:0},
                {id:"QSwPJPZpeDs",start:1},
                {id:"HsWfny7XVNI",start:1},
                {id:"JLVnT6-QNKY",start:1},
                {id:"f16cwfdSuOQ",start:0},
                {id:"VNTXQTb_5hk",start:0},
                {id:"z4ZipKdI1sY",start:1},
                {id:"Y_iPB7qgCiM",start:3},
                {id:"4L_DQKCDgeM",start:0},
                {id:"StdCqJ9qCiU",start:0},
                {id:"TYjW67HKhl4",start:0},
                {id:"OlZc3olHtp8",start:5},
                {id:"404tSfsP3eI",start:18},
                {id:"SWsStfj33Zg",start:1},
                {id:"8TFvlvbl-30",start:2},
                {id:"MY3A-xLLJXw",start:0},
                {id:"qwDBE-87NWE",start:4},
                {id:"iZ29Dsec54A",start:0},
                {id:"pXfTtKcrUWI",start:1},
                {id:"pIaIPaDfhec",start:0},
                {id:"J-DlH5LcH2g",start:11},
                {id:"x08XOMrAQzg",start:0},
                {id:"7RujKG9hmCY",start:9},
                {id:"9jMC6vmZo2w",start:0},
                {id:"WsJIDptF-2c",start:0},
                {id:"ZRuYQ9KRJms",start:0},
                {id:"CTW0ifgY9zc",start:10},
                {id:"vO0RZJu5m24",start:2},
                {id:"Cy44ocuoWhE",start:2},
                {id:"GaFOOykGHjc",start:0},
                {id:"6CNkMBIvios",start:1},
                {id:"HVS72L8VsFk",start:1},
                {id:"uu7J_Idw_S4",start:0},
                {id:"BdS73mMycjI",start:0},
                {id:"5R8RyWOKzf8",start:0},
                {id:"tcth3ccFHh0",start:1},
                {id:"pz1BosPBGlo",start:1},
                {id:"7x0MWZX8Aeg",start:0},
                {id:"-2VRd8EtYzM",start:1},
                {id:"oIrYHNH7OfY",start:2},
                {id:"eS2QCfQE9qY",start:4},
                {id:"EseMHr6VEM0",start:7},
                {id:"YYDqWDTw65U",start:0},
                {id:"9bCyWqNTZvQ",start:15},
                {id:"KTmatjyd4KM",start:1},
                {id:"Sv2je9arNz4",start:14},
                {id:"cx1qW_iG5nA",start:1},
                {id:"3qQ0MCFttFc",start:0},
                {id:"qdrY-qhP0Oo",start:3},
                {id:"p_RNy7nlgjY",start:0},
                {id:"eq1UwbDGEGo",start:0},
                {id:"a-f5KXvHmUE",start:5},
                {id:"rZ642zSpQgc",start:6},
                {id:"WyXkgHzS458",start:0},
                {id:"n4PE6gK2odM",start:6},
                {id:"gi3MeTuA7Hw",start:0},
                {id:"T4KNVT2w0mU",start:22},
                {id:"d0v2jgCDA1g",start:2},
                {id:"6XP-f7wPM0A",start:0},
                {id:"mOiOG-Ss17Y",start:0},
                {id:"_HsBjJ58RWA",start:0},
                {id:"L9NCvSakgR8",start:1},
                {id:"QvYSckKSL5g",start:3},
                {id:"Ys8ReXj1Ygw",start:6},
                {id:"JUl5z_QUm8A",start:8},
                {id:"HyAHJEDCxxM",start:0},
                {id:"wZf41UudAbI",start:19},
                {id:"UionAcrKjsQ",start:3},
                {id:"UlWcsjVC3n8",start:7},
                {id:"PoUYeE602jM",start:4},
                {id:"O192eo9zbT4",start:15},
                {id:"23GwYVIOLqk",start:0},
                {id:"ddFj_eMPCnE",start:1.5},
                {id:"d2SNX3bfYKw",start:0},
                {id:"c41IFA3N7UE",start:0},
                {id:"9w1atvkVQnE",start:0},
                {id:"BNg7fNiBmjI",start:25},
                {id:"ddFj_eMPCnE",start:1.5},
                {id:"d2SNX3bfYKw",start:0},
                {id:"c41IFA3N7UE",start:0},
                {id:"9w1atvkVQnE",start:0},
                {id:"BNg7fNiBmjI",start:25}
            ],
            current_video: 0,
            is_first: 1,
            // player: '',
            videoId: '',
            playerVars: {
                autoplay: 0,
                start: 0,
                loop: 0,
                enablejsapi: 1,
                rel: 1,
                origin : window.location.href,
                widget_referrer: window.location.href,
                fs: 0,
                disablekb: 1,
                playsinline: 1
            },
            isFullscreen: 0,
            isPlaying: 0
        }
    },
    mounted() {
        // this.playVideo();
        this.videoId = this.videos[this.current_video].id;
        this.playerVars.start = this.videos[this.current_video].start;

        $('.music-btn').click(function() {
            if($('.music-list').css('display') == 'none') {
                $('.music-list').css('display', 'flex');
            } else {
                $('.music-list').css('display', 'none');
            }
            
        });
    },
    computed: {
        player() {
            return this.$refs.youtube.player
        }
    },
    methods: {
        playNextSong() {
            if(this.videos.length-1 > this.current_video) {
                this.current_video += 1;
            } else if(this.videos.length-1 == this.current_video) {
                this.current_video = 0;
            }

            this.playVideo();
        },
        playPrevSong() {
            if(this.current_video != 0) {
                this.current_video -= 1;
            } else {
                this.current_video = 0;
            }

            this.playVideo();
        },
        playAudio() {
            // $('.music-player-div iframe').remove();
            // console.log(this.current_video);
            var video = this.videos[this.current_video];
            var video_id = video.id;
            var start = video.start;
            var video_player = 'youtube-player';
            
            // $('.music-player-div .video-container').append('<div id="youtube-player"></div>')
            // player.pauseVideo();
            player = new YT.Player(video_player, {
                height: '100%',
                width: '100%',
                videoId: video_id,
                playerVars: {
                    autoplay: 1,
                    loop: 0,
                    start: start,
                    enablejsapi: 1,
                    rel: 0,
                    origin : window.location.href,
                    widget_referrer: window.location.href,
                    fs: 0
                    // disablekb: 1
                },
                events: {
                    'onReady': this.onPlayerReady,
                    'onStateChange': this.onPlayerStateChange 
                } 
            });
        },
        playVideo() {
            this.videoId = this.videos[this.current_video].id;
            this.playerVars.start = this.videos[this.current_video].start;
            this.playerVars.autoplay = 1;
            
            this.player.playVideo()
        },
        playing() {
            this.isPlaying = 1;
            // console.log('\o/ we are watching!!!')
        },
        pausedVideo() {
            this.isPlaying = 0;
        },
        playFullscreen (){
            // player.playVideo();//won't work on mobile
            // togglePlayButton(true);
            
            // check if fullscreen mode is available
            // if (document.fullscreenEnabled || 
            //     document.webkitFullscreenEnabled || 
            //     document.mozFullScreenEnabled ||
            //     document.msFullscreenEnabled) {
                
            //     // which element will be fullscreen
            //     var iframe = document.querySelector('.music-list iframe');
            //     // Do fullscreen
            //     if (iframe.requestFullscreen) {
            //     iframe.requestFullscreen();
            //     } else if (iframe.webkitRequestFullscreen) {
            //     iframe.webkitRequestFullscreen();
            //     } else if (iframe.mozRequestFullScreen) {
            //     iframe.mozRequestFullScreen();
            //     } else if (iframe.msRequestFullscreen) {
            //     iframe.msRequestFullscreen();
            //     }
            // }
            this.isFullscreen = 1;
            $('.music-list').addClass('fullscreen');

        },
        exitFullscreen() {
            this.isFullscreen = 0;
            $('.music-list').removeClass('fullscreen');
        },
        closePlayer() {
            $('.music-list').hide();

            if(this.isPlaying) {
                this.player.playVideo()
            }
        }
    }
}
</script>