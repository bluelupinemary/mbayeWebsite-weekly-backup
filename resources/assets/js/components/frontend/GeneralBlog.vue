<template>
<div>
<div class="page view ">

    <div class="origin view">
        <div id="camera" class="view">
            <div id="dolly" class="view">
                <div id="stack" class="view" v-touch:swipe.left="lefthandler" v-touch:swipe.right="righthandler">
                    <div v-for="(general_blog,index) in general_blogs" :key="index" :class="'cell fader view original div_img div_img_'+index" :block_no="index" v-for-callback="{key: index, array: general_blogs, callback: callback}" :style="blockStyle(index)" style="opacity: 0;" @click.prevent="playAudio('div_img_'+index)">
                        
                        <a class="mover viewflat blog_img" href="#">
                            <input type="hidden" name="audio" :value="general_blog.audio">
                            <img :class="'cell_img_'+index" :src="'/storage/img/general_blogs/'+general_blog.featured_image" @load="layoutImageInCell('cell_img_'+index, index)">
                            
                        </a>
                            
                        <div class="overlay">
                            <div v-if="general_blog.shared == false" :class="'div_title_'+index+' div_title'" style="display:none;z-index:10000000;border:0px solid white">
                                <p class="p_title">{{general_blog.name}}</p>
                            </div>

                            <div v-else-if="general_blog.shared" :class="'div_title_'+index+' div_title text_left'" style="display:none;z-index:10000000;border:0px solid white">
                                <p class="p_title">Title: {{general_blog.name}}</p>
                                <p class="p_title">Owner: {{general_blog.owner.first_name}} {{general_blog.owner.last_name}}</p>
                            </div>

                            <li v-if="general_blog.shared" :class="'tag tag_'+index"><i class="fas fa-tag"></i> Shared</li>

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
                                
                                <button class="button btn_view_blog" @click.prevent="viewBlog(general_blog.id)"><p class="p_button">View Blog</p></button>
                            </div>
                        </div>

                        <div :class="'div_count_bg'+index+' div_count_bg div_count_regular '+general_blog.most_reaction" >
                            <div class="button-div button-div-l ">
                                <button><img :src="'/front/icons/hot.png'" class="hotIcon" /></button>
                                <div class="button-details">
                                    <p class="button-number">{{general_blog.hotcount}}</p>
                                </div>
                            </div>
                            
                            <div class="button-div button-div-l ">
                                <button><img :src="'/front/icons/cool.png'" class="coolIcon" /></button>
                                <div class="button-details">
                                    <p class="button-number">{{general_blog.coolcount}}</p> 
                                </div>
                            </div>
                            
                            <div class="button-div button-div-l ">
                                <button><img  :src="'/front/icons/naff.png'" class="naffIcon" /></button>
                                <div class="button-details">
                                    <p class="button-number">{{general_blog.naffcount}}</p>
                                </div>
                            </div>
                            
                            <div class="button-div button-div-l ">
                                <button><img :src="'/front/icons/comment.png'"  class="commentIcon" alt="" ></button>
                                <div class="button-details">
                                    <p class="button-number">{{general_blog.commentcount}}</p>
                                </div>
                            </div>
                        </div>

                        <div :class="'div_count_bg'+index+' div_count_bg div_count_small '+general_blog.most_reaction" >
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
<div v-if="k == 0" style="width: 100px;
    height: 100px;
    position: fixed;
    top: 0px;
    z-index: 10000000 !important;
    left: 0;">
    <button class="btn btn-primary" style="position:absolute;">sometext</button>
    <!-- <button v-else class="btn btn-danger" style="position:absolute;">sometext</button> -->
</div>
<div v-else style="width: 100px;
    height: 100px;
    position: fixed;
    top: 0px;
    z-index: 10000000 !important;
    left: 0;">
    <button class="btn btn-danger" @click.prevent="fetchblogs" style="position:absolute;">Remount</button>
    <!-- <button v-else class="btn btn-danger" style="position:absolute;">sometext</button> -->
</div>
</div>
</template>

<script>
import EventBus from '../../frontend/event-bus';
export default {
    props: {
        user_id: Number,
        type: ''
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
            general_blogs: {},
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
            audio_player: new Audio()
        }
    },
    // created() {
    //     this.fetchblogs();
    //     // this.broadcastcheck();
        
        
    // },
    mounted () {
    this.fetchblogs();
    Echo.channel('general_blogs')
                .listen('GeneralBlogEvent',(response) => {
                    console.log(response);
                    // let i=0;
                    this.newblog[this.k] = response;
                    this.k++;
                    // this.fetchblogs();
                    // let arr= [];
                    // Object.keys(this.general_blogs).map(key=>{
                    //         arr.push(this.general_blogs[key])
                    // })
                    // arr.unshift(response);  
                    // this.general_blogs = arr;
                });
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
        // console.log('v-for loop finished')
        // this.updateStack(1);
        // let that = this;
        // that.lastAudioNum = 3;
        // that.currentAudio = 0;
    },
    lefthandler(){
          this.scrollcheck('down');
      },
    righthandler(){
          this.scrollcheck('up');
      },
    //   broadcastcheck(){
    //       axios.get("/fetchgeneralblogs?page="+this.page+'&user_id='+this.user_id)
    //      .then((response) => {
    //         this.images=response.data.data;
    //         jQuery.each(this.images,this.testfunc);
    //     })
    //     .catch((error) => {
    //         console.log(error);
    //     }) 
    //   },
    fetchblogs() {
        let that = this;
       /* Calling API for fetching images */
        axios.get("/fetchgeneralblogs?page="+that.page+'&user_id='+that.user_id+'&type='+that.type)
        .then((response) => {
            // debugger
    //    console.log(response.data);
            that.images=response.data.data;
            // console.log(that.images.id);
            that.current_page=response.data.current_page;
            that.last_page=response.data.last_page;
            that.Total_pages=(response.data.total/25);
            that.Total_pages=parseInt( that.Total_pages);
            that.Total_count=response.data.total;
            that.snowstack_init();
            that.cellCount = response.data.to;
            console.log('cell count: ', that.cellCount);
            that.general_blogs = {};
            // var i = 0;
            that.k = 0;
            $.each(response.data.data, function(index, value) {
                if(value.blog) {
                    that.$set(that.general_blogs, index, value.blog);
                    that.general_blogs[index].shared = true;
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
            // that.general_blogs = response.data.data;
            console.log(that.general_blogs);

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
    scrollcheck(scroll)
    {  
        // console.log('scroll: '+scroll);
        let that = this;
            if (scroll=='up' || scroll=='down' || scroll=='left' || scroll=='right')
            {
                if (that.scrolltimer === null)
                {
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
            }
            else
            {
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
                
                    /* scroll up */
                    if (that.newcell >= 3)
                    {
                        that.newcell -= 3;
                        $(".most-naffed").show();
                    }
                }
        
      


                 if (scroll=='right')
                { 
                     
                $(".most-naffed").hide();
                    if(  that.cellCount>(that.newcell+3))
                        {
                            that.loading = false;
        
                        }   
                           
                  
                    /* scroll down */
               
                if(that.page==that.last_page) {
                    that.loading = true;
                    if(that.newcell+4==that.cellCount)
                    {     
                        // console.log(that.cellCount)
                        that.updateStack(that.newcell+4, that.magnifyMode);
                    }
                    // that.loading = false;
                    
                }

                if ((that.newcell+3) < (that.cellCount)) {
                    that.newcell += 3;
                } else if (!that.loading) { 
                    /* We hit the right wall, add some more */
                
                    that.page = that.page+1 ;
                    that.loading = true;
                    
                    // debugger
                    // alert($(that).tagvalue.name);
                    var url_api=url+"/fetchgeneralblogs?page="+that.page+'&user_id='+that.user_id+'&type='+that.type;
                    $.getJSON(url_api, function(data) 
                    {
                        console.log(data.data, that.cellCount);

                        var i = that.cellCount;
                        $.each(data.data, function(index, value) {
                            if(value.blog) {
                                that.$set(that.general_blogs, i, value.blog);
                            } else {
                                that.$set(that.general_blogs, i, value);
                            }
                            that.general_blogs[i].audio = that.getAudio();

                            i++;
                        });

                        that.cellCount = data.to;
                        // that.general_blogs.concat(data.data);
                        console.log(that.general_blogs, that.cellCount);
                        // that.updateStack(1);
                        that.loading = false;
                    // if((that.newcell + 3) != that.images.length)
                    //         jQuery.each(that.images,that.snowstack_addimage);
                
                
                    });
                } 
               
                }

                if(scroll == 'up')
                {
                    /* Up Arrow */
                    that.newcell -= 1;
                }
                if (scroll == 'down')
                {
                    /* Down Arrow */
                    that.newcell += 1;
                }
              
                //if((newcell + 3)!=that.images.length)
                  that.updateStack(that.newcell, that.magnifyMode);
       },
    snowstack_addimage(reln, info)
    {
        // debugger;
        console.log(reln);
         
        let that = this;
        // console.log(that.images[reln]['id']);
        var n=1;
        that.load_count++;
            var nHot_Count;
            var nCool_Count;
            var nNaff_Count;
            var nComment_Count;
            if(that.images[reln]['hotcount']!==null){
                nHot_Count=that.images[reln]['hotcount'];
            }
            else
            nHot_Count=0;


            if(that.images[reln]['coolcount']!==null){
                nCool_Count=that.images[reln]['coolcount'];
            }
            else
            nCool_Count=0;


            if(that.images[reln]['naffcount']!==null){
                nNaff_Count=that.images[reln]['naffcount'];
            }
            else
            nNaff_Count=0;

            if(that.images[reln]['commentcount']!==null){
                nComment_Count=that.images[reln]['commentcount'];
            }
            else
            nComment_Count=0;

        if((nHot_Count/1000)>=1)
        nHot_Count=nHot_Count/1000+"K";

        if((nCool_Count/1000)>=1)
        nCool_Count=nCool_Count/1000+"K";

        if((nNaff_Count/1000)>=1)
        nNaff_Count=nNaff_Count/1000+"K";

        if((nComment_Count/1000)>=1)
        nComment_Count=nComment_Count/1000+"K";

        var cell = {};
        // jQuery("#stack").empty();
        var realn = that.cellCount;
        that.cells.push(cell);
    
        var x = Math.floor(realn / 2);
        var y = realn - x * 2;
        cell.info = info;
        
        cell.div = jQuery('<div class="cell fader view original div_img" style="opacity: 0" block_no="'+reln+'" ></div>').width(that.CWIDTH).height(that.CHEIGHT);
        cell.div[0].style.webkitTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        cell.div[0].style.MozTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        cell.div[0].style.msTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        cell.div[0].style.OTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
    
        var img = document.createElement("img");
        var title=info.name  ;
        var id=info.id  ;
        var content=info.content  ;
        var url="/single_blog/"+id;
      
        jQuery(img).load(function ()
        {
         
            var width;
            var height;
            var height_for_count;
            var top;
            var bottom;
            var left;
            img.className  = "cell_img_"+that.i;
           
            layoutImageInCell(img, cell.div[0]);

            var cls_overlay="div_overlay_"+that.i;
            var cls_title="div_title_"+that.i;
            var cls_counts="div_counts_"+that.i;
           
       
           cell.div.append(jQuery('<a class="mover viewflat blog_img" href="#""  onclick="play_note('+reln+')"></a>').append(img));
           cell.div.append(jQuery('<div class="'+cls_title+' div_title" style="display:none;z-index:10000000;border:0px solid white"><p class="p_title">'+title+'</p></div>'));
           cell.div.append(jQuery('<div class="'+cls_overlay+' div_overlay '+reln+'" style="z-index:1000000;display:none;opacity: 100%; background-color:rgba(23, 80, 213, 0.57)"> <div class="blog-buttons_overlay "> <div class="button-div"><button><img class="i_hot" src="/front/icons/hot.png"/></button><div class="button-details"><p class="button-number hot-number">'+nHot_Count+'</p></div></div><div class="button-div"><button><img class="i_cool" src="/front/icons/cool.png" /></button><div class="button-details"> <p class="button-number cool-number">'+nCool_Count+'</p></div></div> <div class="button-div"> <button><img class="i_naff" src="/front/icons/naff.png" /></button><div class="button-details"><p class="button-number naff-number">'+nNaff_Count+'</p></div></div><div class="button-div"><button><img  class="i_comment" src="/front/icons/comment.png" alt=""></button> <div class="button-details"><p class="button-number comment-number">'+nComment_Count+'</p></div> </div> </div><button class="button btn_view_blog" onclick="viewBlog('+id+')"><p class="p_button">View Blog</p></button></div>'));
          
            var div_height=$(".div_img").css("height");
            var div_width=$(".div_img").css("width");
            var div_img=$(".cell_img_"+that.i).css("height");

            
             var pos = $(".cell_img_"+that.i).position();
             width=Math.round(img.width)+1;
             height=Math.round(img.height)+2;
             var height_title=Math.round(img.height)/5
             top=$(".cell_img_"+that.i).css("top");
             bottom=$(".cell_img_"+that.i).css("bottom");
             left=$(".cell_img_"+that.i).css("left");

             var className="div_count_icon"+that.i;
             var className_bg="div_count_bg"+that.i;
           
        
        $(".div_overlay_"+that.i).css({width:width, height:height,
                                                "position":"absolute",
                                                 left:left,top:top});
        $(".div_title_"+that.i).css({'display':'none',width:width, height:height_title,
                                                "position":"absolute",
                                                 left:left,top:top}); 
        $(".div_counts_"+that.i).css({'display':'none',width:width, height:height,
                                                "position":"absolute",
                                                left:left,top:top});

        if (width > height){
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-l "><button><img src="/front/icons/hot.png" class="hotIcon" /></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="/front/icons/cool.png" class="coolIcon" /></button><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div></div><div class="button-div button-div-l "><button><img  src="/front/icons/naff.png" class="naffIcon" /></button><div class="button-details"><p class="button-number">'+nNaff_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="/front/icons/comment.png"  class="commentIcon" alt="" ></button><div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div></div>'));
             }
             else{
            
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-p "><button><img src="/front/icons/comment.png"  class="commentIcon" alt="" ></button> <div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div><div class="button-div button-div-p "><div class="button-details"><p class="button-number">'+nNaff_Count+'</p></div>  <button><img class="naffIcon" src="/front/icons/naff.png"/></button> </div><div class="button-div button-div-p"><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div><button><img src="/front/icons/cool.png" class="coolIcon"/></button> </div><div class="button-div button-div-p"><button><img src="/front/icons/hot.png" class="hotIcon"/></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div></div>'));
                 }
        
        largest(nHot_Count,nCool_Count,nNaff_Count,that.i);
        cell.div.addClass('div_img_' + that.i);
        if (width > height){ 
       
                //it's a landscape
                $(".div_title_"+that.i).css({"text-align":"left"});
                $(".div_img").attr('type','L');
                top='85%';
                var img_height=height+'px';
        
                        if(div_height===img_height){
                            top='85%';
                        } 
                       else if(div_height=='206px'&& img_height=='193px'){
                            top='79%';
                        }   
                        height="15%";
             
            } 
        else {
                height="30%";
                //it's a portrait
                $(".div_title_"+that.i).css({"text-align":"center"});
                top='70%';
                }
                $(".div_count_bg"+that.i).css({"position":"absolute","width":width,
                                                    "float":"right","border":"0px solid white",
                                                    "height":height,"top":top,"left":left,'opacity':'35%','border':'0px solid white'});

         
           cell.div.css("opacity", 1);
        that.i++;
           n++;
           });
        
            img.src = info.thumb;
    
             jQuery("#stack").append(cell.div);
             //first row for reflection
        if (y == 1)
        {
            cell.reflection = jQuery('<div class="cell fader view reflection" style="opacity: 0"></div>').width(that.CWIDTH).height(that.CHEIGHT);
            cell.reflection[0].style.webkitTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            cell.reflection[0].style.MozTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            cell.reflection[0].style.msTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            cell.reflection[0].style.OTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            var rimg = document.createElement("img");
            
            jQuery(rimg).load(function ()
            {
                layoutImageInCell(rimg, cell.reflection[0]);
                cell.reflection.append(jQuery('<div class="mover viewflat"></div>').append(rimg));
                cell.reflection.css("opacity", 1);
            });
        
            rimg.src = info.thumb;
    
            jQuery("#rstack").append(cell.reflection);
        }
        //second row for reflection
        if (y == 0)
        {
            cell.reflection = jQuery('<div class="cell fader view reflection2" style="opacity: 0"></div>').width(that.CWIDTH).height(that.CHEIGHT);
            cell.reflection[0].style.webkitTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            cell.reflection[0].style.MozTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            cell.reflection[0].style.msTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
            cell.reflection[0].style.OTransform = that.translate3d(x * that.CXSPACING, y * that.CYSPACING, 0);
        
            var rimg = document.createElement("img");
            
            jQuery(rimg).load(function ()
            {
                layoutImageInCell(rimg, cell.reflection[0]);
                cell.reflection.append(jQuery('<div class="mover viewflat"></div>').append(rimg));
                cell.reflection.css("opacity", 1);
            });
        
            rimg.src = info.thumb;
    
            jQuery("#rstack2").append(cell.reflection);
        }
    },
     updateStack(newIndex, newmagnifymode)
    {
        console.log('newIndex:' +newIndex);
        var currentTimer = null;  
        var dolly = jQuery("#dolly")[0];
        var camera = jQuery("#camera")[0];
        let that = this;
        $(".overlay").css({'display':'none'});//for hiding overlay
        // $(".div_title").css({'display':'none'});
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
    
        if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
            {//alert("here1");
                dolly.style.OTransform = that.cameraTransformForCell(newIndex);
                var currentMatrix = new OCSSMatrix(document.defaultView.getComputedStyle(dolly, null).OTransform);
                var targetMatrix = new OCSSMatrix(dolly.style.OTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
                camera.style.OTransform = "rotateY(" + angle + "deg)";
                camera.style.OTransitionDuration = "330ms";

            }
        else if(navigator.userAgent.indexOf("Chrome") != -1 )
        { //alert("here2");
            dolly.style.webkitTransform = that.cameraTransformForCell(newIndex);
            var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
            var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
            var dx = currentMatrix.e - targetMatrix.e;
            var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
            camera.style.webkitTransform = "rotateY(" + angle + "deg)";
            camera.style.webkitTransitionDuration = "330ms";

        }
    
        else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
        { 
        
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
        else if(navigator.userAgent.indexOf("iPhone") != -1 )
      {
            dolly.style.webkitTransform = that.cameraTransformForCell(newIndex);
            var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
            var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
            var dx = currentMatrix.e - targetMatrix.e;
            var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
            camera.style.webkitTransform = "rotateY(" + angle + "deg)";
            camera.style.webkitTransitionDuration = "330ms";

        }
        else if(navigator.userAgent.toLowerCase().indexOf('safari/') > -1)
      {
            dolly.style.webkitTransform = that.cameraTransformForCell(newIndex);
            var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
            var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
            var dx = currentMatrix.e - targetMatrix.e;
            var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;
            angle=angle-7.5;
            camera.style.webkitTransform = "rotateY(" + angle + "deg)";
            camera.style.webkitTransitionDuration = "330ms";

        }
        
        else{
       
        }      
    
        if (currentTimer)
        {
            clearTimeout(currentTimer);
        }
        
        currentTimer = setTimeout(function ()
        {
            if(navigator.userAgent.indexOf("Chrome") != -1 )
             {
                camera.style.webkitTransform = "rotateY(0)";
                camera.style.webkitTransitionDuration = "2s";
             }
             else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
             {
                camera.style.MozTransform = "rotateY(0)";
                camera.style.MozTransitionDuration = "2s";
             }

             else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
            {

            camera.style.msTransform = "rotateY(0)";
            camera.style.msTransitionDuration = "2s";
             }
            
             else if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
            {
            camera.style.OTransform = "rotateY(0)";
            camera.style.OTransitionDuration = "2s";
            }
            else if(navigator.userAgent.indexOf("iPhone") != -1 ){
                camera.style.webkitTransform = "rotateY(0)";
                camera.style.webkitTransitionDuration = "2s";
            }
        }, 330);
    },
    updateStack2()
    {
        var currentTimer = null;  
        var dolly = jQuery("#dolly")[0];
        var camera = jQuery("#camera")[0];
        let that = this;
        
        dolly.style.webkitTransform = that.cameraTransformForCell(1);
	
        var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
        var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
        
        var dx = currentMatrix.e - targetMatrix.e;
        var angle = Math.min(Math.max(dx / (that.CXSPACING * 3.0), -1), 1) * 45;

        camera.style.webkitTransform = "rotateY(" + angle + "deg)";
        camera.style.webkitTransitionDuration = "330ms";

        if (currentTimer)
        {
            clearTimeout(currentTimer);
        }
        
        currentTimer = setTimeout(function ()
        {
            camera.style.webkitTransform = "rotateY(0)";
            camera.style.webkitTransitionDuration = "2s";
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
    // commentchange(){
    //     Echo.channel('generalblog'+this.general_blogs[index].id)
    //         .listen('NewGeneralComment',(comment) => {
    //             // console.log(like);
    //             this.general_blogs[index].commentcount=comment.commentcount;
    //         });
    // },
    emotionchange(index) {
        // console.log(this.general_blogs[index].id);
        Echo.channel('generalblogLike'+this.general_blogs[index].id)
            .listen('NewGeneralEmotion',(like) => {
                // console.log(like);
                this.general_blogs[index].hotcount=like.hotcount;
                this.general_blogs[index].coolcount=like.coolcount;
                this.general_blogs[index].naffcount=like.naffcount;
            });

        Echo.channel('generalblog'+this.general_blogs[index].id)
            .listen('NewGeneralComment',(comment) => {
                // console.log(like);
                this.general_blogs[index].commentcount=comment.commentcount;
            });
    },
    layoutImageInCell(img_class, index) {
        let that = this;
        var iwidth = $('.'+img_class).width();
        var iheight = $('.'+img_class).height();
        var cwidth = $('.'+img_class).closest('.cell').width();
        var cheight = $('.'+img_class).closest('.cell').height();
        // console.log('cell width and height: ', cwidth, cheight)
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

        if(that.isOdd(index)) {
            $('.'+img_class).addClass('reflection');
        } else {
            $('.'+img_class).addClass('reflection2');
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
        console.log('current audio: '+this.currentAudio);
        console.log('last audio num: '+this.lastAudioNum);

        var audio = this.audio[this.currentAudio]+''+lastAudioNum;

        this.currentAudio++;

        return audio;
    },
    playAudio(div_class)
    {
        let that = this;
        var music = $('.'+div_class+' input[name="audio"]').val();
        that.audio_player.pause();
        that.audio_player.src = that.url+'/front/audio/'+music+'.mp3';
        that.audio_player.play();
    }
    }
}

</script>
