<template>
<div class="someid">
        <div class="reaction-div" id="thatDiv">
            <button class="zoom-btn zoom-in"><i class="fas fa-search-plus"></i></button>
            <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>
            <img src="/front/images/wholeAstronautBack.png" alt=""
                class="astronaut-body">
                <div class="reaction-button">
                    <button v-if="useremotion == 'naff'" class="tooltips naff selected-reaction"> <img src="/front/icons/naffPicked.png" class="img-button" v-on:click="emotion(2)"/><span class="naff-tooltip">Nuvola thinks that's naff</span></button>
                    <button v-else class="tooltips naff"> <img src="/front/icons/naffPicked.png" class="img-button" v-on:click="emotion(2)"/><span class="naff-tooltip">Nuvola thinks that's naff</span></button>
                    
                    <button v-if="useremotion == 'cool'" class="tooltips cool selected-reaction"><img src="/front/icons/cool300.png" class="img-button" v-on:click="emotion(1)"/><span class="cool-tooltip">Solar reckons it's cool</span></button>
                    <button v-else class="tooltips cool"><img src="/front/icons/cool300.png" class="img-button" v-on:click="emotion(1)"/><span class="cool-tooltip">Solar reckons it's cool</span></button>
                
                    <button class="tooltips comments"><img src="/front/icons/commentsNew.png" class="img-button"/><span class="comment-tooltip">Declarations of Toms</span></button>
                
                    <button  v-if="useremotion == 'hot'" class="tooltips hot selected-reaction"><img src="/front/icons/hotNew.png" class="img-button" v-on:click="emotion(0)"/><span class="hot-tooltip">Nuvola said it's hot</span></button>
                    <button v-else class="tooltips hot"><img src="/front/icons/hotNew.png" class="img-button" v-on:click="emotion(0)"/><span class="hot-tooltip">Nuvola said it's hot</span></button>
                </div>
            <button class="astronaut-butt"></button>
            <audio id="stop_it_se" src="/front/sound-effects/stop-it.mp3"></audio>
        </div>
        <div class="reaction-popup">
            <div>
                <button>
                    <img src="" alt="">
                </button>
                <p v-if="useremotion == 'hot'">{{this.hotcount}}</p>
                <p v-else-if="useremotion == 'cool'">{{this.coolcount}}</p>
                <p v-else>{{this.naffcount}}</p>
            </div>
        </div>
    </div>
</template>

<script>
import EventBus from '../../frontend/event-bus';
      export default {
         props:{
            blog_id:Number,
            user:Object
            },
            data:function() {
            return{
                useremotion: '',
                naff_img: "/front/icons/naffPicked.png",
                cool_img: "/front/icons/cool300.png",
                hot_img: "/front/icons/hotNew.png",
                hotcount:'',
                coolcount:'',
                naffcount:'',
        }
      },
        mounted() {
            this.getuserreaction();
        this.countemotions(this.blog_id);
         Echo.channel('generalblogLike'+this.blog_id)
            .listen('NewGeneralEmotion',(like) => {
               this.countemotions(this.blog_id);
            });
      },
      methods:{
        countemotions(blogid) {
        axios.post('/api/countgeneralemotions', {
            blog_id: blogid,
            })
            .then((response) => {
                this.hotcount= response.data.hot;
                this.coolcount= response.data.cool;
                this.naffcount= response.data.naff;
                const emo = {
                // blog_id : this.blog_id,
                hotcount: response.data.hot,
                coolcount: response.data.cool,
                naffcount: response.data.naff,
                }
                
                EventBus.$emit('GeneralEmotion_sent', emo);
                
                })
            .catch(function (error) {
            console.log(error);
            });  
        },
        getuserreaction() {
          axios.post('/api/usergeneralreaction',{
            blog_id: this.blog_id,
            user_id: this.user.id,
          })
                .then((response) => {
                  this.useremotion = response.data;
                    })
                .catch(function (error) {
                  console.log(error);
                });
        },
        getEmotion:function(emotion_id){
          if(emotion_id == '0') {
                array = {emotion : 'hot', img: hot_img};
            } else if(emotion_id == '1') {
                array = {emotion : 'cool', img: cool_img};
            } else if(emotion_id == '2') {
                array = {emotion : 'naff', img: naff_img};
            }
            return array;
        },
        emotion: function (emotion_id){
            axios.post('/api/blogs/'+this.blog_id+'/generalemotions', {
            user_id: this.user.id,
            emotion: emotion_id,
            blog_id: this.blog_id,
          })
          .then((response) => {
            this.countemotions(this.blog_id);
            this.getuserreaction();
             if(response.data.status == 'like') {
                    var emotion = getEmotion(response.data.data.emotion);
                    if(emotion) {
                        // console.log(response);

                        $('.reaction-popup img').attr('src', emotion.img);
                        $('.reaction-popup img').removeClass('hotIcon');
                        $('.reaction-popup img').removeClass('coolIcon');
                        
                        if(emotion.emotion == 'cool') {
                            $('.reaction-popup img').addClass('coolIcon');
                        } else if(emotion.emotion == 'hot') {
                            $('.reaction-popup img').addClass('hotIcon');
                        }

                        if(emotion.emotion == 'naff' && response.data.naff_fart_status) {
                            animateNaffFartReaction();
                        } else {
                            //$('.reaction-popup img').on('load', function() {
                                $('.reaction-popup').fadeIn('slow', function() {
                                    $('.reaction-popup button').click();
                                    $('.reaction-popup').delay(1000).fadeOut('slow');
                                    $('.reaction-popup button').click();
                                });
                            //}); 
                        }
                    }
            } else if (response.data.status == 'unlike') {
                $('.reaction-button button').removeClass('selected-reaction');
            }
          })
          .catch((error) => {
            console.log(error);
          })
        }
      }
    }  
    function blogMinimize()
        {
            $('.blog-fullview').fadeIn();
            $('.single-blog').removeClass('fullview');
            $('.blog-summary').removeClass('hide-summary');
            $('.blog-body').removeClass('show-blogcontent');
            $('.trix-content').removeClass('show-content');
            $('.blog-buttons').removeClass('fullview');
            $('.blog-buttons').css('opacity', '1');
        }

        $('[data-toggle="tooltip"]').tooltip();

        $('.blog-fullview').click(function() {
            blogFullview();
        });

        $('.blog-minimize').click(function() {
            blogMinimize();
        });
        
</script>
 