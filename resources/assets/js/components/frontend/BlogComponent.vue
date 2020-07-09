<template>
<div class="page view ">

    <div class="origin view">
        <div id="camera" class="view">
            <div id="dolly" class="view">
                <div id="stack" class="view">
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
            tagvalue:Object,
            },
    data:function() {
            return{
                images:[],
        }
    },
  mounted () {
    //   console.log(this.tagvalue);
    this.fetchblogs();
     Echo.channel('new_blog')
            .listen('NewBlogEvent',(response) => {
                console.log(response.data);
                    this.images=[];
                    this.fetchblogs();
            });
  },
  methods:{
    fetchblogs() {
            
        var page = 1;
        var loading = true;
        /* Calling API for fetching images */
        axios.get("/api/v1/blogbytag/"+this.tagvalue.name+"?page="+page)
        .then((response) => {
            page=1;
            this.images=response.data.data;
            console.log(this.images);
            page=response.data.meta.current_page;
            last_page=response.data.meta.last_page;
            Total_pages=(response.data.meta.total/25);
            Total_pages=parseInt(Total_pages);
            Total_count=response.data.meta.total;
            snowstack_init();
            jQuery.each(this.images,this.snowstack_addimage);
            updateStack(1);
            loading = false;
            var keys = {up: true, down: true };
        
            var keymap = { 38: "up", 40: "down" };
            
            var keytimer = null;
            var scrolltimer = null;
            
            function updatekeys()
            { 
                
                var newcell = currentCell;
                if (keys.up)
                {
                    /* Up Arrow */
                    newcell -= 1;
                }
                if (keys.down)
                {
                    /* Down Arrow */
                    newcell += 1;
                }
        
                updateStack(newcell, magnifyMode);
            }

            /* update scroll */


            function updatescroll(scroll)
            { 
                
                var newcell = currentCell;
                if (scroll=='up')
                {
                
                    /* scroll up */
                    if (newcell >= 3)
                    {
                        newcell -= 3;
                        $(".most-naffed").css({'visibility':'visible'});
                    }
                }
        
      


      if (scroll=='down')
                { 
                    if(  cells.length>(newcell+3))
                        {
                            loading = false;
        
                            }   
                            $(".most-naffed").css({'visibility':'hidden'});
                  
                    /* scroll down */
                
              if(page==last_page) {
                  if(newcell+4==cells.length)
                {     
                    updateStack(newcell+4, magnifyMode);
                }
                loading = false;
                  // return false;
              }
              if ((newcell+3) < (cells.length))
          
                    {
                        newcell += 3;
                    }
                    else if (!loading)
                    { 
                        /* We hit the right wall, add some more */
                    
                        page = page+1 ;
                        loading = true;
                      
                
                        let url_api=url+"/api/v1/blogbytag/"+this.tagvalue.name+"?page="+page
                        $.getJSON(url_api, function(data) 
                        {
    
                        this.images=data['data'];
                      
                  
                      if((newcell + 3) != this.images.length)
                              jQuery.each(this.images, this.snowstack_addimage);
                    
                  
                        });
                    
        
                  
                }
                }
              
                //if((newcell + 3)!=this.images.length)
                  updateStack(newcell, magnifyMode);
            }
            
            var delay = 330;
        
          
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
                scrollcheck(scroll_type);
            });
            
        /* scroll check */
      
            function scrollcheck(scroll)
            {  //alert(scroll)
                if (scroll=='up' || scroll=='down')
                {
                    if (scrolltimer === null)
                    {
                        delay = 330;
                        var doTimer = function ()
                        {
                            updatescroll(scroll);
                        //scrolltimer = setTimeout(doTimer, delay);
                            delay = 60;
                        };
                        doTimer();
                    }
                }
                else
                {
                    clearTimeout(scrolltimer);
                    scrolltimer = null;
                }
            }
            
        })
        .catch((error) => {
            console.log(error);
        })      
            
    },
    snowstack_addimage(reln, info)
    {   
        var i=0;
        var n=1;
        load_count++;
    
            var nHot_Count;
            var nCool_Count;
            var nNaff_Count;
            var nComment_Count;

            if(this.images[reln]['hotcount']!==null){
                nHot_Count=this.images[reln]['hotcount'];
            }
            else
            nHot_Count=0;


            if(this.images[reln]['coolcount']!==null){
                nCool_Count=this.images[reln]['coolcount'];
            }
            else
            nCool_Count=0;


            if(this.images[reln]['naffcount']!==null){
                nNaff_Count=this.images[reln]['naffcount'];
            }
            else
            nNaff_Count=0;

            if(this.images[reln]['commentcount']!==null){
                nComment_Count=this.images[reln]['commentcount'];
            }
            else
            nComment_Count=0;

        //change background color based on largeset count


    //    Hot_Count=nHot_Count;
    //    Cool_Count=nCool_Count;
    //    Naff_Count=nNaff_Count;
    //    Comment_Count=nComment_Count;



        if((nHot_Count/1000)>=1)
        nHot_Count=nHot_Count/1000+"K";

        if((nCool_Count/1000)>=1)
        nCool_Count=nCool_Count/1000+"K";

        if((nNaff_Count/1000)>=1)
        nNaff_Count=nNaff_Count/1000+"K";

        if((nComment_Count/1000)>=1)
        nComment_Count=nComment_Count/1000+"K";

        var cell = {};
        var realn = cells.length;
        cells.push(cell);
    
        var x = Math.floor(realn / 2);
        var y = realn - x * 2;
        cell.info = info;
        
        cell.div = jQuery('<div class="cell fader view original div_img" style="opacity: 0" block_no="'+reln+'" ></div>').width(CWIDTH).height(CHEIGHT);
        cell.div[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        cell.div[0].style.MozTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        cell.div[0].style.msTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        cell.div[0].style.OTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
    
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
            img.className  = "cell_img_"+i;
           
            layoutImageInCell(img, cell.div[0]);

            var cls_overlay="div_overlay_"+i;
            var cls_title="div_title_"+i;
            var cls_counts="div_counts_"+i;
           
       
           cell.div.append(jQuery('<a class="mover viewflat blog_img" href="#""  onclick="play_note('+reln+')"></a>').append(img));
           cell.div.append(jQuery('<div class="'+cls_title+' div_title" style="display:none;z-index:10000000;border:0px solid white"><p class="p_title">'+title+'</p></div>'));
           cell.div.append(jQuery('<div class="'+cls_overlay+' div_overlay '+reln+'" style="z-index:1000000;display:none;opacity: 100%; background-color:rgba(23, 80, 213, 0.57)"> <div class="blog-buttons_overlay "> <div class="button-div"><button><img class="i_hot" src="/front/icons/hot.png"/></button><div class="button-details"><p class="button-number hot-number">'+nHot_Count+'</p></div></div><div class="button-div"><button><img class="i_cool" src="/front/icons/cool.png" /></button><div class="button-details"> <p class="button-number cool-number">'+nCool_Count+'</p></div></div> <div class="button-div"> <button><img class="i_naff" src="/front/icons/naff.png" /></button><div class="button-details"><p class="button-number naff-number">'+nNaff_Count+'</p></div></div><div class="button-div"><button><img  class="i_comment" src="/front/icons/comment.png" alt=""></button> <div class="button-details"><p class="button-number comment-number">'+nComment_Count+'</p></div> </div> </div><button class="button btn_view_blog" onclick="viewBlog('+id+')"><p class="p_button">View Blog</p></button></div>'));
          
            var div_height=$(".div_img").css("height");
            var div_width=$(".div_img").css("width");
            var div_img=$(".cell_img_"+i).css("height");

            
             var pos = $(".cell_img_"+i).position();
             width=Math.round(img.width)+1;
             height=Math.round(img.height)+2;
             var height_title=Math.round(img.height)/5
             top=$(".cell_img_"+i).css("top");
             bottom=$(".cell_img_"+i).css("bottom");
             left=$(".cell_img_"+i).css("left");

             var className="div_count_icon"+i;
             var className_bg="div_count_bg"+i;
           
             
        
        $(".div_overlay_"+i).css({width:width, height:height,
                                                "position":"absolute",
                                                 left:left,top:top});
     $(".div_title_"+i).css({'display':'none',width:width, height:height_title,
                                                "position":"absolute",
                                                 left:left,top:top}); 
        $(".div_counts_"+i).css({'display':'none',width:width, height:height,
                                                "position":"absolute",
                                                left:left,top:top});

        if (width > height){
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-l "><button><img src="/front/icons/hot.png" class="hotIcon" /></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="/front/icons/cool.png" class="coolIcon" /></button><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div></div><div class="button-div button-div-l "><button><img  src="/front/icons/naff.png" class="naffIcon" /></button><div class="button-details"><p class="button-number">'+nNaff_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="/front/icons/comment.png"  class="commentIcon" alt="" ></button><div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div></div>'));
             }
             else{
            
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-p "><button><img src="/front/icons/comment.png"  class="commentIcon" alt="" ></button> <div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div><div class="button-div button-div-p "><div class="button-details"><p class="button-number">'+nNaff_Count+'</p></div>  <button><img class="naffIcon" src="/front/icons/naff.png"/></button> </div><div class="button-div button-div-p"><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div><button><img src="/front/icons/cool.png" class="coolIcon"/></button> </div><div class="button-div button-div-p"><button><img src="/front/icons/hot.png" class="hotIcon"/></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div></div>'));
         }

     
        
        largest(nHot_Count,nCool_Count,nNaff_Count,i);
           cell.div.addClass('div_img_' + i);
    

           if (width > height){ 
       
                //it's a landscape
                $(".div_title_"+i).css({"text-align":"left"});
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
                $(".div_title_"+i).css({"text-align":"center"});
                top='70%';
                }
                $(".div_count_bg"+i).css({"position":"absolute","width":width,
                                                    "float":"right","border":"0px solid white",
                                                    "height":height,"top":top,"left":left,'opacity':'35%','border':'0px solid white'});

         
           cell.div.css("opacity", 1);
           i++;
           n++;
           });
        
            img.src = info.thumb;
    
             jQuery("#stack").append(cell.div);
             //first row for reflection
        if (y == 1)
        {
            cell.reflection = jQuery('<div class="cell fader view reflection" style="opacity: 0"></div>').width(CWIDTH).height(CHEIGHT);
            cell.reflection[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.MozTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.msTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.OTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
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
            cell.reflection = jQuery('<div class="cell fader view reflection2" style="opacity: 0"></div>').width(CWIDTH).height(CHEIGHT);
            cell.reflection[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.MozTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.msTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.OTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        
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
    }
  }
}

</script>
