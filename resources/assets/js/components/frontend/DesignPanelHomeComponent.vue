<template>
<div class="page view ">

    <div class="origin view">
        <div id="camera" class="view">
            <div id="dolly" class="view">
                <div id="stack" class="view" v-touch:swipe.left="lefthandler" v-touch:swipe.right="righthandler">
                </div>
                <div id="mirror" class="view">
                    <div id="rstack" class="view">
                    </div>
                    <div id="rstack2" class="view">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:{
          
            },
    data:function() {
            return{
                images:[],
                load_count:0,
                scrolltimer:null,
                delay:330,
                cells : [],
                currentCell:-1,
                magnifyMode : false,
                last_page:'',
                Total_pages:0,
                i:0,
                page:1,
                loading:true,
                newcell:Number,
                CWIDTH:Number,
                CHEIGHT:Number,
                CGAP : 5,
                CXSPACING:Number,
                CYSPACING:Number,
             

        }
    },
  mounted () {
    
    this.fetchblogs();
     Echo.channel('designpanel_blogs')
            .listen('DesignPanelBlogEvent',(response) => {
                console.log(response);
                    this.fetchblogs();
            });
  },
  methods:{
    lefthandler(){
          this.scrollcheck('down');
      },
    righthandler(){
          this.scrollcheck('up');
      },
    fetchblogs() { 
    
        let that = this;
        /* Calling API for fetching images */
        axios.get("/api/v1/all_designed_panels?page="+ that.page)
        .then((response) => {
            that.images=response.data.data;
            var images = response.data.data;
            that.page=response.data.meta.current_page;
            that.last_page=response.data.meta.last_page;
            that.Total_pages=(response.data.meta.total/25);
            that.Total_pages=parseInt(that.Total_pages);
            Total_count=response.data.meta.total;
            that.snowstack_init();
            jQuery("#stack").empty();
            jQuery("#rstack").empty();
            // jQuery("#mirror").empty();
            jQuery("#rstack2").empty(); 
            jQuery.each(that.images,that.snowstack_addimage);
            that.updateStack(1);
            that.loading = false;
            var keys = {up: true, down: true };
            var keymap = { 38: "up", 40: "down" };
            
            var keytimer = null;
            var scrolltimer = null;
            
            /** Update images on keys */
            function updatekeys()
            { 
                
              that.newcell = that.currentCell;
                if (keys.up)
                {
                    /* Up Arrow */
                    that.newcell -= 1;
                }
                if (keys.down)
                {
                    /* Down Arrow */
                    that.newcell += 1;
                }
        
                that.updateStack(that.newcell, that.magnifyMode);
            }

          
          
        /*
          ------SCROLLL EVENT FUNCTIONS ON MOUSE WHEEL ------
        */
            window.addEventListener('wheel', function(event)
            {

                if (event.deltaY < 0)
                {
                    scroll_type='up';

                }
                else if (event.deltaY > 0)
                {
                    scroll_type='down'; 
                    
                } 
                that.scrollcheck(scroll_type);
            });
            /* scroll check */
      
            // that.scrollcheck()
        })
        .catch((error) => {
            console.log(error);
        })  
            
    },
     scrollcheck(scroll)
        {  
            let that = this;
                if (scroll=='up' || scroll=='down')
                {
                    if (that.scrolltimer === null)
                    {
                       that.delay = 330;
                        var doTimer = function ()
                        {
                           that.updatescroll(scroll);
                        //scrolltimer = setTimeout(doTimer, delay);
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
                if (scroll=='up')
                {
                
                    /* scroll up */
                    if (that.newcell >= 3)
                    {
                         that.newcell -= 3;
                        $(".most-naffed").css({'visibility':'visible'});
                    }
                }
        
      


                 if (scroll=='down')
                { 
                    if(  that.cells.length>( that.newcell+3))
                        {
                             that.loading = false;
        
                            }   
                            // $(".most-naffed").css({'visibility':'hidden'});
                  
                    /* scroll down */
             
              if( that.page==that.last_page) {
                   that.loading = true;
                  if( that.newcell+4==that.cells.length)
                {     
                    that.updateStack( that.newcell+4, that.magnifyMode);
                }
                //  that.loading = false;
                  // return false;
              }
              if (( that.newcell+3) < (that.cells.length))
          
                    {
                         that.newcell += 3;
                    }
                    else if (! that.loading)
                    { 
                        /* We hit the right wall, add some more */
                    
                         that.page =  that.page+1 ;
                         that.loading = true;
                      
                        // debugger
                        // alert($(that).tagvalue.name);
                        var url_api=url+"/api/v1/all_designed_panels?page="+ that.page
                        $.getJSON(url_api, function(data) 
                        {
    
                            that.images=data['data'];
                      
                  
                      if(( that.newcell + 3) != that.images.length)
                              jQuery.each(that.images,that.snowstack_addimage);
                    
                  
                        });
                    
        
                  
                }
                }
              
                //if((newcell + 3)!=that.images.length)
                  that.updateStack( that.newcell, that.magnifyMode);
       },
    snowstack_addimage(reln, info)
    {  
        let that = this;
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
        var realn = that.cells.length;
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
           cell.div.append(jQuery('<div class="'+cls_overlay+' div_overlay '+reln+'" style="z-index:1000000;display:none;opacity: 100%; background-color:rgba(23, 80, 213, 0.57)"> <div class="blog-buttons_overlay "> <div class="button-div"><button><img class="i_hot" src="/front/icons/hot.png"/></button><div class="button-details"><p class="button-number hot-number">'+nHot_Count+'</p></div></div><div class="button-div"><button><img class="i_cool" src="/front/icons/cool.png" /></button><div class="button-details"> <p class="button-number cool-number">'+nCool_Count+'</p></div></div><div class="button-div"><button><img  class="i_comment" src="/front/icons/comment.png" alt=""></button> <div class="button-details"><p class="button-number comment-number">'+nComment_Count+'</p></div> </div> </div><button class="button btn_view_blog" onclick="viewBlog('+id+')"><p class="p_button">View Blog</p></button></div>'));
          
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
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-l "><button><img src="/front/icons/hot.png" class="hotIcon" /></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="/front/icons/cool.png" class="coolIcon" /></button><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div></div><div class="button-div button-div-l "><button><img src="/front/icons/comment.png"  class="commentIcon" alt="" ></button><div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div></div>'));
             }
             else{
            
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-p comment_div"><button><img src="/front/icons/comment.png" class="commentIcon"  alt="" /></button><div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div><div class="button-div button-div-p "><div class="button-details"><p class="button-number">'+nCool_Count+'</p></div><button><img src="/front/icons/cool.png" class="coolIcon"/></button></div><div class="button-div button-div-p"><button><img src="/front/icons/hot.png" class="hotIcon"/></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div></div>'));
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
        var currentTimer = null;  
        var dolly = jQuery("#dolly")[0];
        var camera = jQuery("#camera")[0];
        let that = this;
        $(".div_overlay").css({'display':'none'});//for hiding overlay
        $(".div_title").css({'display':'none'});
        $(".div_count_text").css({'display':'block'});
        $(".div_btn").css({'display':'none'});
        $(".div_count_bg").css({'display':'flex'});
  
        if (that.currentCell == newIndex && that.magnifyMode == newmagnifymode)
        {
            return;
        }
    
        var oldIndex = that.currentCell;
        newIndex = Math.min(Math.max(newIndex, 0), that.cells.length - 1);
        that.currentCell = newIndex;
      
        if (oldIndex != -1)
        {
            var oldCell = that.cells[oldIndex];
            oldCell.div.attr("class", "cell fader view original div_img");	
            if (oldCell.reflection)
            {
                oldCell.reflection.attr("class", "cell fader view reflection");
            }
        }
   
        var cell = that.cells[newIndex];
        cell.div.addClass("selected");
        if (cell.reflection)
        {
          //  cell.reflection.addClass("selected");
        }
    
        that.magnifyMode = newmagnifymode;
        
        if (that.magnifyMode)
        {
            cell.div.addClass("magnify");
            refreshImage(cell.div.find("img")[0], cell);
        }
    
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
     cameraTransformForCell(n)
    {
        let that = this;
        //adjusting translation animation
       if(n==1)
            count=0.5;
        else
            count+=0.5;

        var x = Math.floor(n / 3);
        var y = n - x * 3;
      
       if(n==1)
       {
                    var cx = (x +0.5) * that.CXSPACING;
       }
       else{
                    if(scroll_type=='up') //adjusting translation animation
                    {  
                            if(n==Total_count)
                                count=0.5;
                            else
                                count-=1;

                        var cx = (x +count) * that.CXSPACING; 
                        }
                    else{
                        var cx = (x +count) * that.CXSPACING; 
                        }
            }
      

        var cy = (y + 0.5) * that.CYSPACING;
      
       //scroll_type
     
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

        jQuery("#mirror")[0].style.webkitTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
        jQuery("#mirror")[0].style.MozTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
        jQuery("#mirror")[0].style.msTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
        jQuery("#mirror")[0].style.OTransform = "scaleY(-1.0) " + that.translate3d(0, - that.CYSPACING * 4 - 1, 0);
    },
    translate3d(x, y, z)
    {
        return "translate3d(" + x + "px, " + y + "px, " + z + "px)";
    },
  }
}

</script>
