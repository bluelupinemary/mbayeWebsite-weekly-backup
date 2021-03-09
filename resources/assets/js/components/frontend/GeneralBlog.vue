<template>
<div>
    <div class="page view ">
        <div class="origin view">
            <div id="camera" class="view">
                <div id="dolly" class="view">
                    <div id="stack" class="view" v-touch:swipe.left="lefthandler" v-touch:swipe.right="righthandler">
                        <div v-for="(general_blog,index) in general_blogs" :key="index" :class="'cell fader view original div_img div_img_'+index" :block_no="index" v-for-callback="{key: index, array: general_blogs, callback: callback}" :style="blockStyle(index)" style="opacity: 0;">
                            <a class="mover viewflat blog_img" href="#" data-image="" @click.prevent="playAudio('div_img_'+index, general_blog)">
                                <input type="hidden" name="audio" :value="general_blog.audio">
                                <img :class="'cell_img_'+index+' '+(general_blog.shared ? 'green-border' : '')" :src="'/storage/img/general_blogs/'+general_blog.featured_image" @load="layoutImageInCell('cell_img_'+index, index)" :data-index="index">
                                
                            </a>
                                
                            <div class="overlay">
                                <div class="blog-title">
                                    <div v-if="general_blog.shared == false" :class="'div_title_'+index+' div_title text_left'" style="display:none;z-index:10000000;border:0px solid white;width:90%;">
                                        <p class="p_title">Title: {{general_blog.name}}</p>
                                        <p class="p_title">Owner: {{general_blog.owner.first_name}} {{general_blog.owner.last_name}}</p>
                                    </div>

                                    <div v-else-if="general_blog.shared" :class="'div_title_'+index+' div_title text_left'" style="display:none;z-index:10000000;border:0px solid white">
                                        <p class="p_title">Title: {{general_blog.name}}</p>
                                        <p class="p_title">Owner: {{general_blog.owner.first_name}} {{general_blog.owner.last_name}}</p>
                                    </div>

                                    <li v-if="general_blog.shared" :class="'tag tag_'+index"><i class="fas fa-tag"></i> Shared</li>
                                </div>

                                <div :class="'div_overlay_'+index+' div_overlay '+index"> 
                                    <div class="blog-buttons_overlay ">
                                        <div class="button-div">
                                            <button><img class="i_hot" :src="'/front/icons/hot.png'"/></button>
                                            <div class="button-details">
                                                <p class="button-number hot-number">{{general_blog.hotcount}}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="button-div">
                                            <button><img class="i_cool" :src="'/front/icons/cool.png'" /></button>
                                            <div class="button-details"> 
                                                <p class="button-number cool-number">{{general_blog.coolcount}}</p>
                                            </div>
                                        </div> 
                                        
                                        <div class="button-div"> 
                                            <button><img class="i_naff" :src="'/front/icons/naff.png'" /></button>
                                            
                                            <div class="button-details">
                                                <p class="button-number naff-number">{{general_blog.naffcount}}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="button-div">
                                            <button><img  class="i_comment" :src="'/front/icons/comment.png'" alt=""></button> 
                                            
                                            <div class="button-details">
                                                <p class="button-number comment-number">{{general_blog.commentcount}}</p>
                                            </div> 
                                        </div> 
                                    </div>
                                    
                                    <button v-if="general_blog.shared" class="button btn_view_blog" @click.prevent="viewSharedBlog(general_blog.shared_id)"><p class="p_button">View Blog</p></button>
                                    <button v-else class="button btn_view_blog" @click.prevent="viewBlog(general_blog.id)"><p class="p_button">View Blog</p></button>
                                </div>
                            </div>
                            <li v-if="general_blog.shared" :class="'tag tag_'+index+' front'"><i class="fas fa-tag"></i> Shared</li>
                            <div :class="'div_count_bg'+index+' div_count_bg div_count_regular '+general_blog.most_reaction" @click.prevent="playAudio('div_img_'+index, general_blog)">
                                <div class="button-div button-div-l hot">
                                    <button><img :src="'/front/icons/hot.png'" class="hotIcon" /></button>
                                    <div class="button-details">
                                        <p class="button-number">{{general_blog.hotcount}}</p>
                                    </div>
                                </div>
                                
                                <div class="button-div button-div-l cool">
                                    <button><img :src="'/front/icons/cool.png'" class="coolIcon" /></button>
                                    <div class="button-details">
                                        <p class="button-number">{{general_blog.coolcount}}</p> 
                                    </div>
                                </div>
                                
                                <div class="button-div button-div-l naff">
                                    <button><img  :src="'/front/icons/naff.png'" class="naffIcon" /></button>
                                    <div class="button-details">
                                        <p class="button-number">{{general_blog.naffcount}}</p>
                                    </div>
                                </div>
                                
                                <div class="button-div button-div-l comment">
                                    <button><img :src="'/front/icons/comment.png'"  class="commentIcon" alt="" ></button>
                                    <div class="button-details">
                                        <p class="button-number">{{general_blog.commentcount}}</p>
                                    </div>
                                </div>
                            </div>

                            <div :class="'div_count_bg'+index+' div_count_bg div_count_small '+general_blog.most_reaction" @click.prevent="playAudio('div_img_'+index, general_blog)">
                                <div class="button-div button-div-p ">
                                    <button><img src="/front/icons/comment.png"  class="commentIcon" alt="" ></button> 
                                    
                                    <div class="button-details"><p class="button-number">{{general_blog.commentcount}}</p></div>
                                </div>
                                
                                <div class="button-div button-div-p ">
                                    <div class="button-details"><p class="button-number">{{general_blog.naffcount}}</p></div>  
                                    
                                    <button><img class="naffIcon" src="/front/icons/naff.png"/></button> 
                                </div>
                                
                                <div class="button-div button-div-p">
                                    <div class="button-details"><p class="button-number">{{general_blog.coolcount}}</p> </div>
                                    
                                    <button><img src="/front/icons/cool.png" class="coolIcon"/></button> 
                                </div>
                                
                                <div class="button-div button-div-p">
                                    <button><img src="/front/icons/hot.png" class="hotIcon"/></button>
                                    
                                    <div class="button-details"><p class="button-number">{{general_blog.hotcount}}</p></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- <div id="mirror" class="view">
                        <div id="rstack" class="view">
                        </div>
                        <div id="rstack2" class="view">
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div v-if="general_blogs.length == 0 && current_page == '1'" class="no-data-message">
        <p class="no-result">{{message}}</p>
    </div>
    <div class="last_page">
        <p>End of posts</p>
    </div>
    <div v-if="user" :class="'astro-div navigator-div '+getUserGender(user.gender)">
        <img v-if="user.gender == 'female'" src="/front/images/astronut/Thomasina_blog.png"  class="astronaut-img" alt="">
        <img v-else src="/front/images/astronut/Tom_blog.png" alt="" class="astronaut-img">
        <div :class="'tos-div '+getUserGender(user.gender)">
            <button class="tos-btn tooltips right">
                <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/tosBtn.png" alt="">
                <span class="tooltiptext">Terms of Services</span>
            </button>
        </div>
        <div :class="'user-photo '+(user.gender != null ? user.gender: 'male')">
            <img :src="'/storage/profilepicture/'+(user.photo == null ? 'default.png' : (user.photo.includes('-cropped') ? 'crop/'+user.photo : user.photo))">
        </div>
        <div :class="'tag-title '+(user.gender != null ? user.gender: 'male')">
            <img :src="'/front/images/planets/Jupiter.png'"/>
        </div>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img class="btn_pointer" src="/front/images/astronut/navigator-buttons/musicBtn.png" alt="">
                    <span class="tooltiptext">Music on/off</span></button>
                <button class="home-btn tooltips left"><img class="btn_pointer" src="/front/images/astronut/navigator-buttons/homeBtn.png" alt="">
                    <span class="tooltiptext">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img class="btn_pointer" src="/front/images/astronut/navigator-buttons/greenButtons.png" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="participate-btn tooltips right">
                    <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/freeBtn.png" alt="">
                    <span class="tooltiptext">Participate</span>
                </button>
                <button class="profile-btn tooltips right">
                    <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/profileBtn.png" alt="">
                    <span class="tooltiptext">User Profile</span>
                </button>
            </div>
        </div>
        <button class="zoom-btn zoom-in zoom-in-out tooltips">
            <i class="fas fa-search-plus"></i>
            <span>Zoom In</span>
        </button>
        <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
        <div class="instructions-div btn_pointer tooltips right">
            <button class="instructions-btn tooltips right">
                <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/instructionsBtn.png" alt="">
                <span class="tooltiptext">Instructions</span>
            </button>
        </div>
        <div class="communicator-div tooltips top">
            <span class="tooltiptext">Communicator</span>
            <button class="communicator-button"></button>
        </div>
        <div v-if="type != ''" class="new-posts-div">
            <img src="/front/images/notification-hologram/hologram-horizontal.png" alt="" class="hologram">
            <button class="new-posts" @click.prevent="fetchblogs" :disabled="(k == 0 ? true : false)">
                <span v-if="k > 0" class="light"></span>
                New Posts
            </button>
        </div>
        <button class="navigator-zoomout-btn zoom-in-out tooltips">
            <i class="fas fa-undo-alt"></i>
            <span>Zoom Out</span>
        </button>
    </div>
    <div v-else :class="'astro-div navigator-div tom'">
        <img src="/front/images/astronut/Trevor_Blog.png" alt="" class="astronaut-img">
        <div :class="'tos-div tom'">
            <button class="tos-btn tooltips right">
                <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/tosBtn.png" alt="">
                <span class="tooltiptext">Terms of Services</span>
            </button>
        </div>
        <div :class="'tag-title male'">
            <img :src="'/front/images/planets/Jupiter.png'"/>
        </div>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img class="btn_pointer" src="/front/images/astronut/navigator-buttons/musicBtn.png" alt="">
                    <span class="tooltiptext">Music on/off</span></button>
                <button class="home-btn tooltips left"><img class="btn_pointer" src="/front/images/astronut/navigator-buttons/homeBtn.png" alt="">
                    <span class="tooltiptext">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img class="btn_pointer" src="/front/images/astronut/navigator-buttons/greenButtons.png" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="participate-btn tooltips right">
                    <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/freeBtn.png" alt="">
                    <span class="tooltiptext">Participate</span>
                </button>
                <button class="profile-btn tooltips right">
                    <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/profileBtn.png" alt="">
                    <span class="tooltiptext">User Profile</span>
                </button>
            </div>
        </div>
        <button class="zoom-btn zoom-in zoom-in-out tooltips">
            <i class="fas fa-search-plus"></i>
            <span>Zoom In</span>
        </button>
        <div class="instructions-div btn_pointer tooltips right">
            <button class="instructions-btn tooltips right">
                <img class="btn_pointer" src="/front/images/astronut/navigator-buttons/instructionsBtn.png" alt="">
                <span class="tooltiptext">Instructions</span>
            </button>
        </div>
        <div class="communicator-div tooltips top">
            <span class="tooltiptext">Communicator</span>
            <button class="communicator-button"></button>
        </div>
        <div v-if="type != ''" class="new-posts-div">
            <img src="/front/images/notification-hologram/hologram-horizontal.png" alt="" class="hologram">
            <button class="new-posts" @click.prevent="fetchblogs" :disabled="(k == 0 ? true : false)">
                <span v-if="k > 0" class="light"></span>
                New Posts
            </button>
        </div>
        <button class="navigator-zoomout-btn zoom-in-out tooltips">
            <i class="fas fa-undo-alt"></i>
            <span>Zoom Out</span>
        </button>
    </div>
    <div class="sliding-images-controls">
        <button class="slide-left" @click.prevent="righthandler"><i class="fas fa-angle-left"></i></button>
        <button class="slide-right" @click.prevent="lefthandler"><i class="fas fa-angle-right"></i></button>
    </div>
</div>
</template>

<script>
import EventBus from '../../frontend/event-bus';
export default {
    props: {
        user: '',
        user_id: Number,
        type: '',
        friend: ''
    },
    data:function() {
        return {
            url: $('meta[name="url"]').attr('content'),
            images:[],
            load_count:0,
            count:0,
            scroll_type:String,
            scrolltimer:null,
            delay:330,
            cells : [],
            currentCell:-1,
            magnifyMode : false,
            last_page:'',
            Total_pages:0,
            Total_count:0,
            i:0,
            page:1,
            current_page:Number,
            loading:true,
            newcell:Number,
            CWIDTH:Number,
            CHEIGHT:Number,
            CGAP : 5,
            CXSPACING:Number,
            CYSPACING:Number,
            newblog:[],
            k:0,
            general_blogs: [],
            prevNum:0,
            currentNum:0,
            cellCount:Number,
            currentAudio: 0,
            lastAudioNum: 3,
            audio: [
                'c',
                'd',
                'e',
                'f',
                'g',
                'a',
                'b'
            ],
            audio_player: {
                'c3': '../../../front/audio/c3.mp3',
                'd3': '../../../front/audio/d3.mp3',
                'e3': '../../../front/audio/e3.mp3',
                'f3': '../../../front/audio/f3.mp3',
                'g3': '../../../front/audio/g3.mp3',
                'a3': '../../../front/audio/a3.mp3',
                'b3': '../../../front/audio/b3.mp3',
                'c4': '../../../front/audio/c4.mp3',
                'd4': '../../../front/audio/d4.mp3',
                'e4': '../../../front/audio/e4.mp3',
                'f4': '../../../front/audio/f4.mp3',
                'g4': '../../../front/audio/g4.mp3',
                'a4': '../../../front/audio/a4.mp3',
                'b4': '../../../front/audio/b4.mp3',
                'c5': '../../../front/audio/c5.mp3',
                'd5': '../../../front/audio/d5.mp3',
                'e5': '../../../front/audio/e5.mp3',
                'f5': '../../../front/audio/f5.mp3',
                'g5': '../../../front/audio/g5.mp3',
                'a5': '../../../front/audio/a5.mp3',
                'b5': '../../../front/audio/b5.mp3',
                'c6': '../../../front/audio/c6.mp3',
                'd6': '../../../front/audio/d6.mp3',
                'e6': '../../../front/audio/e6.mp3',
                'f6': '../../../front/audio/f6.mp3',
                'g6': '../../../front/audio/g6.mp3',
                'a6': '../../../front/audio/a6.mp3',
                'b6': '../../../front/audio/b6.mp3',
            },
            fart: new Audio('../../../front/audio/fart/fart.mp3'),
        }
    },
    mounted () {
        this.fetchblogs();

        var that = this;
        Echo.channel('general_blogs')
        .listen('GeneralBlogEvent',(response) => {
            console.log(response);
            // let i=0;
            if(that.user_id == 0) {
                this.newblog[this.k] = response;
                this.k++;
            } else if(that.user_id != 0 && that.type == 'friend' && response.blog_tags.created_by == that.user_id) {
                this.newblog[this.k] = response;
                this.k++;
            }
        });

        Echo.channel('new_general_blog_share')
        .listen('NewGeneralBlogShareEvent',(response) => {
            console.log(response);
            // let i=0;
            if(that.user_id == 0) {
                this.newblog[this.k] = response;
                this.k++;
            } else if(that.user_id != 0 && that.type == 'friend' && response.blog_tags.created_by == that.user_id) {
                this.newblog[this.k] = response;
                this.k++;
            }
        });

        // echo listen for newgeneralblogshare event
    },
    directives: {
        forCallback(el, binding) {
        let element = binding.value
        var key = element.key
        var len = 0

        if (Array.isArray(element.array)) {
            len = element.array.length
        }

        else if (typeof element.array === 'object') {
            var keys = Object.keys(element.array)
            key = keys.indexOf(key)
            len = keys.length
        }

        if (key == len - 1) {
            if (typeof element.callback === 'function') {
            element.callback()
            }
        }
        }
    },
    methods:{
        callback() {
            this.message = 'No stories.';
        },
        lefthandler(){
            this.scroll_type = 'right';
            this.scrollcheck(this.scroll_type);
        },
        righthandler(){
            this.scroll_type = 'left';
            this.scrollcheck(this.scroll_type);
        },
        fetchblogs() {
            let that = this;
            that.page = 1;
            that.currentAudio = 0;
            that.lastAudioNum = 3;
            that.general_blogs = [];

            that.message = 'Fetching stories...';

            /* Calling API for fetching images */
            axios.get("/fetchgeneralblogs?page="+that.page+'&user_id='+that.user_id+'&type='+that.type)
            .then((response) => {
                // debugger
                console.log(response);

                if(response.data.data.length == 0) {
                    that.message = 'No blogs.';
                }

                that.images=response.data.data;
                // console.log(that.images.id);
                //  $('#stack').empty();
                that.current_page=response.data.current_page;
                that.last_page=response.data.last_page;
                that.Total_pages=(response.data.total/25);
                that.Total_pages=parseInt( that.Total_pages);
                that.Total_count=response.data.total;
                that.snowstack_init();
                that.cellCount = response.data.to;

                that.k = 0;
                $.each(response.data.data, function(index, value) {
                    if(value.blog) {
                        that.$set(that.general_blogs, index, value.blog);
                        that.general_blogs[index].shared = true;
                        that.general_blogs[index].shared_id = value.id;
                    } else {
                        that.$set(that.general_blogs, index, value);
                        that.general_blogs[index].shared = false;
                    }
                    that.emotionchange(index);
                    // that.commentchange(index)
                    that.general_blogs[index].audio = that.getAudio();
                    // that.general_blogs.push(value);
                    // i++;
                });

                // jQuery.each(that.images,that.snowstack_addimage);
                that.updateStack(1);
                that.loading = false;
                var keys = {up: true, down: true };
                var keymap = { 38: "up", 40: "down" };
                
                var keytimer = null;
                var scrolltimer = null;
                
                /** Update images on keys */
                // function updatekeys()
                // { 
                //     console.log('run updatekeys');
                //      that.newcell = that.currentCell;
                //     if (keys.up)
                //     {
                //         /* Up Arrow */
                //           that.newcell -= 1;
                //     }
                //     if (keys.down)
                //     {
                //         /* Down Arrow */
                //           that.newcell += 1;
                //     }
            
                //     that.updateStack(that.newcell, that.magnifyMode);
                // }
            
                
                /*
                ------SCROLLL EVENT FUNCTIONS ON MOUSE WHEEL ------
                */
                window.addEventListener('wheel', function(event)
                {

                    if (event.deltaY < 0)
                    {
                        that.scroll_type='left';

                    }
                    else if (event.deltaY > 0)
                    {
                        that.scroll_type='right'; 
                        
                    } 
                    that.scrollcheck(that.scroll_type);
                });

                $(document).keydown(function (e) {
                    var arrow = { left: 37, up: 38, right: 39, down: 40 };
                    
                    switch (e.which) {
                        case arrow.left:
                            that.scroll_type='left'; 
                        break;
                        case arrow.up:
                            that.scroll_type='up'; 
                        break;
                        case arrow.right:
                            that.scroll_type='right'; 
                        break;
                        case arrow.down:
                            that.scroll_type='down'; 
                        break;
                        default:
                            that.scroll_type='';
                        break;
                    }

                    that.scrollcheck(that.scroll_type);
                });

                window.addEventListener("orientationchange", function(event) {
                    // Generate a resize event if the device doesn't do it
                    // window.dispatchEvent(new Event("resize"));
                    that.snowstack_init();
                    reloadImageSize();
                    $('.last_page').hide();
                    that.updateStack(1);
                }, false);

                window.addEventListener("resize", function(event) {
                    // Generate a resize event if the device doesn't do it
                    // window.dispatchEvent(new Event("resize"));
                    that.snowstack_init();
                    reloadImageSize();
                    $('.last_page').hide();
                    that.updateStack(1);
                }, false);

                function reloadImageSize()
                {
                    // alert();
                    $(".blog_img img").each(function() {  
                        var image_class = $(this).attr('class');
                        if(image_class.includes('green-border')) {
                            image_class = image_class.replace(" green-border", "");
                        }

                        var index = $(this).data('index');
                        that.blockStyleDiv(index);
                        that.layoutImageInCell(image_class, index);
                    });  
                }

                /* scroll check */
        
                // that.scrollcheck()
                // $(window).load(function() {
                //     that.blockStyle();
                // });
                
            })
            .catch((error) => {
                console.log(error);
            })  
                
        },
        blockStyle(index) {
            // console.log('index: '+index);
            let that = this;
            // var index = 0;
            // var cell = {};
            // var realn = that.cellCount;
            // console.log(realn);
            // if(index < that.Total_count) {
                
                // console.log(realn);
            // }

            
            var realn = index;
            // console.log('realn: '+realn);
            var x = Math.floor(realn / 2);
            var y = realn - x * 2;

            // that.currentNum = x;
            // console.log('blockStyle: ', that.currentNum, that.prevNum)
            // if(that.currentNum != that.prevNum) {
            //     that.prevNum = that.currentNum;
            //     // that.cells.push([]);
            // }
            // $('.div_img_'+index).css({
            //     'width': that.CWIDTH,
            //     'height': that.CHEIGHT,
            //     'transform' : that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0)
            // });
            return {
                'width': that.CWIDTH,
                'height': that.CHEIGHT,
                '-webkit-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                '-moz-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                '-ms-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                '-o-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                'transform' : that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0)
            };

            // index++;
        // }
        
        // that.CHEIGHT = Math.round(window.innerHeight / 3.5);
        // that.CWIDTH  = Math.round(that.CHEIGHT * 300 / 180);
        // that.CXSPACING = that.CWIDTH + that.CGAP;
        // that.CYSPACING = that.CHEIGHT + that.CGAP;
        // var realn = Math.floor(index /2 );
        
        // cell.div[0].style.webkitTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        // cell.div[0].style.MozTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        // cell.div[0].style.msTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        // cell.div[0].style.OTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        },
        blockStyleDiv(index) {
            // console.log('index: '+index);
            let that = this;
            // var index = 0;
            // var cell = {};
            // var realn = that.cellCount;
            // console.log(realn);
            // if(index < that.Total_count) {
                
                // console.log(realn);
            // }

                
                var realn = index;
                // console.log('realn: '+realn);
                var x = Math.floor(realn / 2);
                var y = realn - x * 2;

                // that.currentNum = x;
                // console.log('blockStyle: ', that.currentNum, that.prevNum)
                // if(that.currentNum != that.prevNum) {
                //     that.prevNum = that.currentNum;
                //     // that.cells.push([]);
                // }
                // $('.div_img_'+index).css({
                //     'width': that.CWIDTH,
                //     'height': that.CHEIGHT,
                //     'transform' : that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0)
                // });
                $('.div_img_'+index).css({
                    'width': that.CWIDTH,
                    'height': that.CHEIGHT,
                    '-webkit-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                    '-moz-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                    '-ms-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                    '-o-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                    'transform' : that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0)
                })
                // return {
                //     'width': that.CWIDTH,
                //     'height': that.CHEIGHT,
                //     '-webkit-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                //     '-moz-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                //     '-ms-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                //     '-o-transform': that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0),
                //     'transform' : that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0)
                // };

                // index++;
            // }
            
            // that.CHEIGHT = Math.round(window.innerHeight / 3.5);
            // that.CWIDTH  = Math.round(that.CHEIGHT * 300 / 180);
            // that.CXSPACING = that.CWIDTH + that.CGAP;
            // that.CYSPACING = that.CHEIGHT + that.CGAP;
            // var realn = Math.floor(index /2 );
            
            // cell.div[0].style.webkitTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            // cell.div[0].style.MozTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            // cell.div[0].style.msTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            // cell.div[0].style.OTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        },
        scrollcheck(scroll)
        {  
            // console.log('scroll: '+scroll);
            let that = this;
            if (scroll=='left' || scroll=='right') {
                if (that.scrolltimer === null) {
                    that.delay = 330;
                    var doTimer = function ()
                    {
                        // console.log('scroll: '+scroll);
                        that.updatescroll(scroll);
                        // that.scrolltimer = setTimeout(doTimer, that.delay);
                        that.delay = 60;
                    };
                    doTimer();
                }
            } else {
                clearTimeout(that.scrolltimer);
                that.scrolltimer = null;
            }
        },
        updatescroll(scroll)
        { 
            let that = this;
            that.newcell = that.currentCell;
            console.log('newcell: ',that.newcell);
            if (scroll=='left')
            {
                $('.last_page').css('display', 'none');

                if(that.newcell > 3) {
                    $(".most-naffed").show();
                }
                /* scroll up */
                if (that.newcell >= 3)
                {
                    that.newcell -= 3;
                }
            } else if (scroll=='right') {
                if(that.newcell >= 3) {
                    $(".most-naffed").hide();
                }
                // if(  that.cellCount>(that.newcell+3))
                //     {
                //         that.loading = false;
    
                //     }   
                        
                
                /* scroll down */
                if(that.page==that.last_page) {
                    that.loading = true;
                    if(that.newcell+4==that.cellCount)
                    {     
                        // console.log(that.cellCount)
                        that.updateStack(that.newcell+4, true);
                        return;
                    }

                    if(that.Total_count == that.general_blogs.length && (that.newcell+3) >= (that.cellCount)) {
                        if($('.last_page').css('display') == 'none') {
                            $('.last_page').css('display', 'flex').hide().fadeIn();
                        }
                    }

                    // that.loading = false;
                } else {
                    that.loading = false;
                }

                if ((that.newcell+3) < (that.cellCount)) {
                    that.newcell += 3;
                    $('.last_page').css('display', 'none');
                } else if (!that.loading) { 
                    /* We hit the right wall, add some more */
                
                    $('.last_page').css('display', 'none');
                    that.page = that.page+1 ;
                    that.loading = true;
                    
                    // debugger
                    // alert($(that).tagvalue.name);
                    // var url_api=url+"/fetchgeneralblogs?page="+that.page+'&user_id='+that.user_id+'&type='+that.type;
                    axios.get("/fetchgeneralblogs?page="+that.page+'&user_id='+that.user_id+'&type='+that.type)
                    .then((response) => {
                    // $.getJSON(url_api, function(data) 
                    // {
                        var data = response.data;
                        // console.log(response);
                        // console.log(that.cellCount);
                        var i = Object.keys(that.general_blogs).length;
                        $.each(data.data, function(index, value) {
                            // console.log('i: '+i);
                            // console.log(value);
                            if(value.blog) {
                                that.$set(that.general_blogs, i, value.blog);
                                that.general_blogs[i].shared = true;
                                that.general_blogs[i].shared_id = value.id;
                            } else {
                                that.$set(that.general_blogs, i, value);
                                that.general_blogs[i].shared = false;
                            }
                            that.general_blogs[i].audio = that.getAudio();

                            that.emotionchange(i);
                            i++;
                        });

                        that.cellCount = Object.keys(that.general_blogs).length;
                        // // that.general_blogs.concat(data.data);
                        // console.log(that.general_blogs, that.cellCount);
                        // // that.updateStack(1);
                        that.loading = false;
                    // if((that.newcell + 3) != that.images.length)
                    //         jQuery.each(that.images,that.snowstack_addimage);
                
                
                    });
                } 
                
            }

            // if(scroll == 'up')
            // {
            //     /* Up Arrow */
            //     that.newcell -= 1;
            // }
            // if (scroll == 'down')
            // {
            //     /* Down Arrow */
            //     that.newcell += 1;
            // }
            
            //if((newcell + 3)!=that.images.length)
            that.updateStack(that.newcell, that.magnifyMode);
        },
        updateStack(newIndex, newmagnifymode)
        {
            // console.log('newIndex:' +newIndex);
            var currentTimer = null;  
            var dolly = jQuery("#dolly")[0];
            var camera = jQuery("#camera")[0];
            let that = this;
            $(".overlay").css({'display':'none'});//for hiding overlay
            $(".tag.front").show();
            $(".div_count_text").css({'display':'block'});
            $(".div_btn").css({'display':'none'});
            $(".div_count_bg").css({'display':'flex'});
    
            if (that.currentCell == newIndex && that.magnifyMode == newmagnifymode)
            {
                return;
            }
        
            var oldIndex = that.currentCell;
            newIndex = Math.min(Math.max(newIndex, 0), that.cellCount - 1);
            
            that.currentCell = newIndex;
        
            // if (oldIndex != -1)
            // {
            //     var oldCell = that.cells[oldIndex];
            //     oldCell.div.attr("class", "cell fader view original div_img");	
            //     if (oldCell.reflection)
            //     {
            //         oldCell.reflection.attr("class", "cell fader view reflection");
            //     }
            // }
    
            // var cell = that.cells[newIndex];
            // cell.div.addClass("selected");
            // if (cell.reflection)
            // {
            //   //  cell.reflection.addClass("selected");
            // }
        
            // that.magnifyMode = newmagnifymode;
            
            // if (that.magnifyMode)
            // {
            //     cell.div.addClass("magnify");
            //     refreshImage(cell.div.find("img")[0], cell);
            // }
            // console.log(navigator.userAgent);
            // console.log(navigator.userAgent.indexOf('Chrome'));
            // Opera browsers
            if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
            {
                dolly.style.OTransform = that.cameraTransformForCell(newIndex);
                var currentMatrix = new OCSSMatrix(document.defaultView.getComputedStyle(dolly, null).OTransform);
                var targetMatrix = new OCSSMatrix(dolly.style.OTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
                camera.style.OTransform = "rotateY(" + angle + "deg)";
                camera.style.OTransitionDuration = "330ms";

            }
            else if(navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1)
            {
                // alert();
                dolly.style.webkitTransform = that.cameraTransformForCell(newIndex);
                var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
                var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
                angle=angle-7.5;
                camera.style.webkitTransform = "rotateY(" + angle + "deg)";
                camera.style.webkitTransitionDuration = "330ms";

            }
            else if(navigator.userAgent.indexOf("Chrome") != -1 ) // Chrome and Safari browsers
            {
                dolly.style.webkitTransform = that.cameraTransformForCell(newIndex);
                var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
                var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
                camera.style.webkitTransform = "rotateY(" + angle + "deg)";
                camera.style.webkitTransitionDuration = "330ms";
            }
            
            else if(navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1) // Mozilla browsers
            { 
                // console.log('firefox');
                dolly.style.MozTransform = that.cameraTransformForCell(newIndex);
                var currentMatrix = new DOMMatrix(document.defaultView.getComputedStyle(dolly, null).MozTransform);
                var targetMatrix = new DOMMatrix(dolly.style.MozTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
                camera.style.MozTransform = "rotateY(" + angle + "deg)";
                camera.style.MozTransitionDuration = "330ms";
            }
            else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
            {
                dolly.style.msTransform = that.cameraTransformForCell(newIndex);
                var currentMatrix = new MSCSSMatrix(document.defaultView.getComputedStyle(dolly, null).msTransform);
                var targetMatrix = new MSCSSMatrix(dolly.style.msTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
                camera.style.msTransform = "rotateY(" + angle + "deg)";
                camera.style.msTransitionDuration = "330ms";
            }   
        
            if (currentTimer)
            {
                clearTimeout(currentTimer);
            }
            
            currentTimer = setTimeout(function ()
            {
                if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
                {
                    camera.style.OTransform = "rotateY(0)";
                    camera.style.OTransitionDuration = "2s";
                }
                else if(navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1)
                {
                    camera.style.webkitTransform = "rotateY(0)";
                    camera.style.webkitTransitionDuration = "2s";
                }
                else if(navigator.userAgent.indexOf("Chrome") != -1 )
                {
                    camera.style.webkitTransform = "rotateY(0)";
                    camera.style.webkitTransitionDuration = "2s";
                }
                else if(navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1) 
                {
                    camera.style.MozTransform = "rotateY(0)";
                    camera.style.MozTransitionDuration = "2s";
                }
                else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
                {
                    camera.style.msTransform = "rotateY(0)";
                    camera.style.msTransitionDuration = "2s";
                }
            }, 330);
        },
        cameraTransformForCell(n)
        {
            let that = this;
            //adjusting translation animation
            if(n==1)
                that.count=0.5;
            else
                that.count+=0.5;

            var x = Math.floor(n / 3);
            var y = n - x * 3;
            // var cx = (x + 0.5) * that.CXSPACING;
            // var cy = (y + 0.5) * that.CYSPACING;
            if(n==1)
            {
                var cx = (x +0.5) * that.CXSPACING;
            }
            else {
                if(that.scroll_type=='left') //adjusting translation animation
                {  
                        if(n==that.Total_count)
                            that.count=0.5;
                        else
                            that.count-=1;

                    var cx = (x +that.count) * that.CXSPACING; 
                }
                else {
                    var cx = (x +that.count) * that.CXSPACING; 
                }
            }
        

            var cy = (y + 0.5) * that.CYSPACING;
        
            that.scroll_type
        
            if (that.magnifyMode)
            {
                return that.translate3d(-cx, -cy, 180);
            }
            else
            {
                return that.translate3d(-cx, -cy, 0);
            }	
        },
        snowstack_init()
        {
            let that = this;
            that.CHEIGHT = Math.round(window.innerHeight / 3.5);
            that.CWIDTH  = Math.round(that.CHEIGHT * 300 / 180);
            that.CXSPACING = that.CWIDTH + that.CGAP;
            that.CYSPACING = that.CHEIGHT + that.CGAP;

            // jQuery("#mirror")[0].style.webkitTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
            // jQuery("#mirror")[0].style.MozTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
            // jQuery("#mirror")[0].style.msTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
            // jQuery("#mirror")[0].style.OTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
        },
        translate3d(x, y, z)
        {
            return "translate3d(" + x + "px, " + y + "px, " + z + "px)";
        },
        emotionchange(index) {
            // console.log(this.general_blogs[index].id);
            Echo.channel('generalblogLike'+this.general_blogs[index].id)
                .listen('NewGeneralEmotion',(like) => {
                    // console.log(like);
                    this.generalcountemotions(index);
                });

            Echo.channel('generalblog'+this.general_blogs[index].id)
                .listen('NewGeneralComment',(comment) => {
                    // console.log(like);
                    this.generalcountcomments(index);
                });
        },
        generalcountemotions(index) {
            // debugger;
            // console.log(this.blogs[index].id);
            axios.post('/api/countgeneralemotions', {
                blog_id: this.general_blogs[index].id,
            })
            .then((response) => {
                this.general_blogs[index].hotcount= response.data.hot;
                this.general_blogs[index].coolcount= response.data.cool;
                this.general_blogs[index].naffcount= response.data.naff;
                this.general_blogs[index].most_reaction= response.data.most_reaction;
            })
            .catch(function (error) {
                console.log(error);
            });  
        },
        generalcountcomments(index) {
            // debugger;
            axios.post('/api/countgeneralcomments', {
                blog_id: this.blogs[index].id,
            })
            .then((response) => {
                this.general_blogs[index].commentcount= response.data;
            })
            .catch(function (error) {
                console.log(error);
            });  
        },
        layoutImageInCell(img_class, index) {
            let that = this;
            var iwidth = $('.'+img_class).width();
            var iheight = $('.'+img_class).height();
            var cwidth = $('.'+img_class).closest('.cell').width();
            var cheight = $('.'+img_class).closest('.cell').height();
            // console.log('cell width and height: ', iwidth, iheight)
            var ratio = Math.min(cheight / iheight, cwidth / iwidth);
            
            iwidth *= ratio;
            iheight *= ratio;
            //for putting image in center

            var width_for_count=Math.round(iwidth) + "px";
            var height_for_count= Math.round((iheight) /5)+ "px";
            var top_for_count= Math.round((cwidth - iwidth) / 2) + "px";
            var left_for_count= Math.round((cheight - iheight) / 2) + "px";

            if (iwidth < iheight) {
                $('.'+img_class).closest('.cell').find('.div_count_regular').remove();
                $('.'+img_class).closest('.cell').find('.div_count_small').css('display', 'flex');
            } else {
                $('.'+img_class).closest('.cell').find('.div_count_regular').css('display', 'flex');
                $('.'+img_class).closest('.cell').find('.div_count_small').remove();
            }

            $('.'+img_class).closest('.cell').css({
                // 'width': Math.round(iwidth) + "px",
                // 'height': Math.round(iheight) + "px",
                'opacity': 1
            });

            $('.'+img_class).css({
                'width': Math.round(iwidth) + "px",
                'height': Math.round(iheight) + "px",
                // 'height': '100%',
                'left': Math.round((cwidth - iwidth) / 2) + "px",
                'top': Math.round((cheight - iheight) / 2) + "px"
            });

            $('.'+img_class).closest('.cell').find('.div_count_bg').css({
                'width': Math.round(iwidth) + "px",
                'left': Math.round((cwidth - iwidth) / 2) + "px",
                'bottom': Math.round((cheight - iheight) / 2) + "px"
            });

            $('.'+img_class).closest('.cell').find('.overlay').css({
                'width': Math.round(iwidth) + "px",
                'height': Math.round(iheight) + "px",
                'top': Math.round((cheight - iheight) / 2) + "px",
                'left': Math.round((cwidth - iwidth) / 2) + "px",
            });

            $('.'+img_class).closest('.cell').find('.tag.front').css({
                'top': Math.round((cheight - iheight) / 2) + "px",
                'right': Math.round((cwidth - iwidth) / 2) + "px",
            });

            // console.log($('.view').height());

            if(that.isOdd(index)) {
                $('.'+img_class).closest('.blog_img').addClass('reflection');
                var bottomPos = Math.round(iheight) + 110;

                if(navigator.userAgent.indexOf("Firefox") != -1) {
                    $(`<style type="text/css">
                        .div_img_`+index+` .blog_img:after {
                            background-image: url(`+$('.'+img_class).attr('src')+`);
                            height: `+Math.round(iheight)+`px;
                            bottom: -`+bottomPos+`px;
                        }
                    </style>`).appendTo($('head'));
                }
            } else {
                $('.'+img_class).closest('.blog_img').addClass('reflection2');

                var nextIndex = parseInt(index) + 1;
                var nextImage = $('.div_img_'+nextIndex).height();
                
                if(nextImage == undefined) {
                    var prevIndex = parseInt(index) - 1;
                    nextImage = $('.div_img_'+prevIndex).height();
                    // console.log('next cell height: ', nextImage);
                }

                
                var reflection_pos = (Math.round(nextImage) * 2) + 30;

                $('.'+img_class).closest('.blog_img').attr('style', '-webkit-box-reflect: below '+reflection_pos+'px -webkit-gradient(linear, right top, right bottom, from(rgb(255 255 255 / 0)), to(rgb(255 255 255 / 0.15)))');

                var bottomPos = Math.round(iheight) + (Math.round(nextImage) * 2) + 120;

                if(navigator.userAgent.indexOf("Firefox") != -1) {
                    $(`<style type="text/css">
                        .div_img_`+index+` .blog_img:after {
                            background-image: url(`+$('.'+img_class).attr('src')+`);
                            height: `+Math.round(iheight)+`px;
                            bottom: -`+bottomPos+`px;
                        }
                    </style>`).appendTo($('head'));
                }

                
            }

            
            
            // var audio = that.getAudio();
            // console.log(audio);
            // $('.'+img_class).closest('.blog_img').find('input[name="audio'+index+'"]').val(audio);
        },
        isOdd(value) {
            if (value%2 != 0)
                return true;
            else
                return false;
        },
        viewBlog(id) {
            window.location.href = '/single_general_blog/'+id;
        },
        viewSharedBlog(shared_id) {
            window.location.href = '/shared_story/'+shared_id;
        },
        getAudio()
        {
            if(this.lastAudioNum >= 6) {
                this.lastAudioNum = 3;
            }

            if(this.currentAudio == this.audio.length) {
                this.currentAudio = 0;
                this.lastAudioNum++;
            }

            var lastAudioNum = this.lastAudioNum;

            // console.log('audio length: '+this.audio.length);
            // console.log('current audio: '+this.currentAudio);
            // console.log('last audio num: '+this.lastAudioNum);

            var audio = this.audio[this.currentAudio]+''+lastAudioNum;

            this.currentAudio++;

            return audio;
        },
        playAudio(div_class, general_blog)
        {
            let that = this;
            // general_blog.naffcount = 555;
            if(general_blog.naffcount >= 555) {
                $('.naff-fart-reaction').hide();
                $('.naff-fart-reaction').css('width', '0');

                var fart_audio = new Audio('../../../front/audio/fart/fart.mp3');
                // console.log(fart_audio);
                fart_audio.pause();
                fart_audio.currentTime = 0;
                // that.audio_player[music].src = that.url+'/front/audio/'+music+'.mp3';
                fart_audio.play();

                // $("#overlay").css({'display':'none'});
                // $(".img-nouvela").removeClass("ani-rollout_naff");
                // $(".img-nouvela").css({'display':'block','z-index':'1000'});
                // $(".img-nouvela").addClass("ani-rollout_naff");
                // setTimeout(function(){
                //     $(".img-nouvela").removeClass("ani-rollout_naff");
                //     $(".img-nouvela").css({'display':'none'});
                //     $("#overlay").css({'display':'none'});
                // }, 3000);

                fart_audio.onplaying = function() {
                    // alert();
                    $('.naff-fart-reaction').show();
                    $('.naff-fart-reaction').addClass('animate-naff-fart-reaction');
                    // });
                    
                    $('.naff-fart-reaction').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.naff-fart-reaction').removeClass('animate-naff-fart-reaction');
                        $('.naff-fart-reaction').css('width', '70%');

                        // fart_audio.onended = function() {
                        setTimeout(function() {
                            // alert();
                            $('.naff-fart-reaction').fadeOut(300);
                            $('.naff-fart-reaction').css('width', '0');
                        }, 500);
                            // that.fart.pause();
                            
                        // };
                    });
                };
            } else {
                var music = $('.'+div_class+' input[name="audio"]').val();
                var audio_player = new Audio(that.audio_player[music]);
                audio_player.pause();
                audio_player.currentTime = 0.1;
                // that.audio_player[music].src = that.url+'/front/audio/'+music+'.mp3';
                audio_player.play();
            }
            
        },
        getUserGender(gender) {
            if(gender == null || gender == '' || gender == 'male') {
                return 'tom';
            } else {
                return 'thomasina';
            }
        }
    }
}

</script>
