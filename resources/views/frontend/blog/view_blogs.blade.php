@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
@section('before-styles')
@endsection

@section('content')
<div id="block_land">
    <div class="content">
        <h1 class="text-glow">Turn your device in landscape mode.</h1>
        <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
    </div>
</div>
<div class="page view">

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
@endsection

@section('after-scripts') 
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="text/javascript">

    var CWIDTH;
    var CHEIGHT;
    var CGAP = 5;
    var CXSPACING;
    var CYSPACING;
    var scrtype = '';
    var scrollcount = 1;
    var images=[];
   
    (function () {
          // for showing message to turn to landscape 
          testOrientation();
          window.addEventListener("orientationchange", function(event) {
          testOrientation();
        }, false);

        window.addEventListener("resize", function(event) {
        testOrientation();
        }, false);

        function testOrientation() {
            document.getElementById('block_land').style.display = (screen.width>screen.height) ? 'none' : 'block';
            //above condition is not working sometimes then this condition will work
            if(window.innerHeight< window.innerWidth)
                {
                    document.getElementById('block_land').style.display = 'none' ;
                }
                else{
                    document.getElementById('block_land').style.display =  'block';
                }
        }

        /* Calling API for fetching images */

        var url="http://127.0.0.1:8000/api/v1/blogs";
        $.getJSON(url, function(data) 
        {
           images=data['data'];
       
        });

        // You might need this, usually it's autoloaded   
            jQuery.noConflict();
            /**
            Click function for the div to show the tittle and content and 
            */
           $(document).on("click",".div_img", function () { 
          
            $(".div_count_icon").css({'display':'none'});
            $(".div_count_bg").css({'display':'none'});
            $("#clicked_img .div_overlay").css({'display':'none'});   
            $("#clicked_img .div_title").css({'display':'none'});   
            $("#clicked_img .div_counts").css({'display':'none'});
            $("#clicked_img .div_icons").css({'display':'none'});
            $("#clicked_img .lbl1").css({'display':'none'});
             $("#clicked_img .lbl2").css({'display':'none'});
             $("#clicked_img .lbl3").css({'display':'none'});
             $("#clicked_img .div_btn").css({'display':'none'});

            $('div.cell').removeAttr('id');
            $(this).attr('id','clicked_img');
            var clicked_img_id = $(this).attr('id');
                   
            var img = $("#clicked_img> a>img");
            var pos = $("#clicked_img> a>img").position();

            var  top=$("#clicked_img> a>img").css("top");
            var  left=$("#clicked_img> a>img").css("left");
            var  width=$("#clicked_img> a>img").css("width");
            var  height=$("#clicked_img> a>img" ).css("height");
         
            $("#clicked_img .div_overlay").css({'display':'block'});
            $("#clicked_img .div_title").css({'display':'block'});
            $("#clicked_img .div_counts").css({'display':'block'});
            $("#clicked_img .div_icons").css({'display':'block'});
            $("#clicked_img .div_btn").css({'display':'block'});
            
            $("#clicked_img .lbl1").css({'display':'none'});
            $("#clicked_img .lbl2").css({'display':'none'});
            $("#clicked_img .lbl3").css({'display':'none'});
            
           /* for checking orientation of an image*/

            if (img.width() > img.height()){
                var differernce=img.width() -img.height();
                
            }

         if (img.width() > img.height()){

                        if(differernce<15)
                        { 
                        //for square images 
                        $(".div_icons").css({"display": "none" });
                        $(".div_counts").css({"display": "none" });
                        $("#clicked_img .lbl1").css({'display':'block'});
                        $("#clicked_img .lbl2").css({'display':'block'});
                        $("#clicked_img .lbl3").css({'display':'block'});  
                        }
                        else{
                    
                        //it's a landscape
                        $("#clicked_img .div_counts").css({'display':'block',width:width+1, height:height+1,"position":"absolute"});
                        $("#clicked_img .div_icons .hot .img_hot").css({"transform": "translate(-44%, 353%) !important;"});
                        $("#clicked_img .div_icons .hot .img_hot").css({"transform": "translate(-44%, 353%) !important;"});

                            }
            } 
            else {
                    $(".div_icons").css({"display": "none" });
                    $(".div_counts").css({"display": "none" });
                    $("#clicked_img .lbl1").css({'display':'block'});
                    $("#clicked_img .lbl2").css({'display':'block'});
                    $("#clicked_img .lbl3").css({'display':'block'});
            } 





           

      
});
    
    })();
   
    function translate3d(x, y, z)
    {
        return "translate3d(" + x + "px, " + y + "px, " + z + "px)";
    }
    
    function cameraTransformForCell(n)
    {
      
        var x = Math.floor(n / 3);
        var y = n - x * 3;
        var cx = (x + 0.5) * CXSPACING;
        var cy = (y + 0.5) * CYSPACING;
    
        if (magnifyMode)
        {
            return translate3d(-cx, -cy, 180);
        }
        else
        {
            return translate3d(-cx, -cy, 0);
        }	
    }
    
    var currentCell = -1;
    
    var cells = [];
    
    var currentTimer = null;
    
    var dolly = jQuery("#dolly")[0];
    var camera = jQuery("#camera")[0];
    
    var magnifyMode = false;
    
    var zoomTimer = null;
    
    function refreshImage(elem, cell)
    {
        if (cell.iszoomed)
        {
            return;
        }
    
        if (zoomTimer)
        {
            clearTimeout(zoomTimer);
        }
        
        var zoomImage = jQuery('<img class="zoom"></img>');
    
        zoomTimer = setTimeout(function ()
        {
            zoomImage.load(function ()
            {
                layoutImageInCell(zoomImage[0], cell.div[0]);
                jQuery(elem).replaceWith(zoomImage);
                cell.iszoomed = true;
            });
    
            zoomImage.attr("src", cell.info.zoom);
    
            zoomTimer = null;
        }, 2000);
    }
    //this is for sizing images through cell height, cell weidth, image height, image weidth
    function layoutImageInCell(image, cell)
    {
  
        var iwidth = image.width;
        var iheight = image.height;
        var cwidth = jQuery(cell).width();
        var cheight = jQuery(cell).height();
        var ratio = Math.min(cheight / iheight, cwidth / iwidth);
        
        iwidth *= ratio;
        iheight *= ratio;
        //for putting image in center
    
        image.style.width = Math.round(iwidth) + "px";
        image.style.height = Math.round(iheight) + "px";
    
        image.style.left = Math.round((cwidth - iwidth) / 2) + "px";
        image.style.top = Math.round((cheight - iheight) / 2) + "px";

        var width_for_count=Math.round(iwidth) + "px";
        var height_for_count= Math.round((iheight) /5)+ "px";
        var top_for_count= Math.round((cwidth - iwidth) / 2) + "px";
        var left_for_count= Math.round((cheight - iheight) / 2) + "px";
  
       $(".div_count").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                            left:left_for_count+"px",top:"80%",'background-color':'green','opacity':'35%'});


     
       $(".div_img .div_count_text").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                                 left:left_for_count+"px",top:"80%"});

                                                
    }
    
    function updateStack(newIndex, newmagnifymode)
    {   
        $(".div_overlay").css({'display':'none'});//for hiding overlay
        $(".div_title").css({'display':'none'});
        $(".div_counts").css({'display':'none'});
        $(".div_count_text").css({'display':'block'});
        $(".div_icons").css({'display':'none'});
        $(".div_icons").css({'display':'none'});
        $(".lbl3").css({'display':'none'});
        $(".lbl2").css({'display':'none'});
        $(".lbl1").css({'display':'none'});
        $(".div_btn").css({'display':'none'});


        $(".div_count_bg").css({'display':'block'});
        $(".div_count_icon").css({'display':'block'});


        
        
        if (currentCell == newIndex && magnifyMode == newmagnifymode)
        {
            return;
        }
    
        var oldIndex = currentCell;
        newIndex = Math.min(Math.max(newIndex, 0), cells.length - 1);
        currentCell = newIndex;
    
        if (oldIndex != -1)
        {
            var oldCell = cells[oldIndex];
            oldCell.div.attr("class", "cell fader view original div_img");	
            if (oldCell.reflection)
            {
                oldCell.reflection.attr("class", "cell fader view reflection");
            }
        }
        
        var cell = cells[newIndex];
        cell.div.addClass("selected");
        if (cell.reflection)
        {
          //  cell.reflection.addClass("selected");
        }
    
        magnifyMode = newmagnifymode;
        
        if (magnifyMode)
        {
            cell.div.addClass("magnify");
            refreshImage(cell.div.find("img")[0], cell);
        }
    
        dolly.style.webkitTransform = cameraTransformForCell(newIndex);
        
        var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
        var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
        
        var dx = currentMatrix.e - targetMatrix.e;
        var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
    
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
    }
    var i=0;
    function snowstack_addimage(reln, info)
    {
      
        var cell = {};
        var realn = cells.length;
        cells.push(cell);
    
        var x = Math.floor(realn / 2);
        var y = realn - x * 2;
        cell.info = info;
        //cell.div = jQuery('<div class="cell fader view original div_img" style="opacity: 0" ></div>').width(CWIDTH).height(CHEIGHT);
        
        cell.div = jQuery('<div class="cell fader view original div_img" style="opacity: 0" ></div>').width(CWIDTH).height(CHEIGHT);
        cell.div[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
    
        var img = document.createElement("img");
        var title=info.name  ;
        var content=info.content  ;
        jQuery(img).load(function ()
        {
           

            var width;
            var height;
            var height_for_count;
            var top;
            var left;
            img.className  = "cell_img_"+i;
           
            
            layoutImageInCell(img, cell.div[0]);
          
            var cls_overlay="div_overlay_"+i;
            var cls_title="div_title_"+i;
            var cls_counts="div_counts_"+i;
            var cls_icons="div_icons_"+i;
      
            cell.div.append(jQuery('<a class="mover viewflat blog_img" href="#"" ></a>').append(img));

            cell.div.append(jQuery('<div class="'+cls_overlay+' div_overlay" style="display:none;opacity: 60%; background-color: #1750d5;"></div>'));
            //cell.div.append(jQuery('<div class="'+cls_title+' div_title" style="display:none;"><p class="p_title">Title:This is the title</p></div>'));
            cell.div.append(jQuery('<div class="'+cls_title+' div_title" style="display:none;"><p class="p_title">'+title+'</p></div>'));
            cell.div.append(jQuery('<div class="'+cls_counts+' div_counts" style="display:none;"><div class="text_hot"><p class="lbl_count">Hot:200</p></div><div class="text_cool"><p class="lbl_count">Cool:200</p></div><div class="text_naff"><p class="lbl_count">Naff:20</p></div>')); 
            cell.div.append(jQuery('<div class="'+cls_icons+' div_icons" style="display:none;"><div class="hot"><img  class="img_hot" src="{{ asset('front') }}/icons/hot.png" alt=""></p></div><div class="cool"><img  class="img_cool" src="{{ asset('front') }}/icons/cool1.png" alt=""></div><div class="naff"><img  class="img_naff" src="{{ asset('front') }}/icons/naff.png" alt=""></div></div>')); 
            
            cell.div.append(jQuery('<div class="lbl1" style="display:none;"><div class="hot_p"><img  class="img_hot_p" src="{{ asset('front') }}/icons/hot.png" alt=""><p class="p_title">Hot:200</p></div></div>')); 
            cell.div.append(jQuery('<div class="lbl2" style="display:none;"><div class="cool_p"><img  class="img_cool_p" src="{{ asset('front') }}/icons/cool1.png" alt=""><p class="p_title">Cool:100</div></div>')); 
            cell.div.append(jQuery('<div class="lbl3" style="display:none;"><div class="naff_p"><img  class="img_naff_p" src="{{ asset('front') }}/icons/naff.png" alt=""><p class="p_title">Naff:20</div></div>')); 
            cell.div.append(jQuery('<div class="div_btn" style="display:none"><button class="button btn_view_blog"><p class="p_button">View Blog</p></button></div>'));
            
            var div_height=$(".div_img").css("height");
            var div_img=$(".cell_img_"+i).css("height");

            
             var pos = $(".cell_img_"+i).position();
             width=Math.round(img.width)+1;
             height=Math.round(img.height)+2;
             top=$(".cell_img_"+i).css("top");
             bottom=$(".cell_img_"+i).css("bottom");
             left=$(".cell_img_"+i).css("left");

             var className="div_count_icon"+i;
             var className_bg="div_count_bg"+i;
            
        
    $(".div_overlay_"+i).css({width:width, height:height,
                                                "position":"absolute",
                                                 left:left,top:top});
     $(".div_title_"+i).css({'display':'none',width:width, height:height,
                                                "position":"absolute",
                                                 left:left,top:top}); 
    $(".div_counts_"+i).css({'display':'none',width:width, height:height,
                                                "position":"absolute",
                                                left:left,top:top});
    if (width > height){
                //it's a landscape
                $(".div_title_"+i).css({"text-align":"left"});
                     
            } 
            else {
                //it's a portrait
                $(".div_title_"+i).css({"text-align":"center"});

                }

           //div for counts for hot cool and naff
           cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ></div>'));
           cell.div.append(jQuery('<div class="'+className+' div_count_icon" ><img  class="img_hot_icon" src="{{ asset('front') }}/icons/hot.png" alt=""><p class="p_title hot_count">200</p> <img  class="img_cool_icon" src="{{ asset('front') }}/icons/cool1.png" alt="">  <p class="p_title cool_count">100</p><img  class="img_naff_icon" src="{{ asset('front') }}/icons/naff.png" alt=""> <p  class="p_title naff_count">20</p></div>'));
           cell.div.addClass('div_img_' + i);
 
            var top_icon;
            if(div_height==div_img){
                top='85%';
                top_icon='83%';
            }
            else{
                top='82%';
                top_icon='79%';
            }
           $(".div_count_bg"+i).css({"position":"absolute","width":width,
                                                    "float":"right","border":"0px solid white",
                                                    "height":"15%","top":top,"left":left,'background-color':'green','opacity':'35%'});
//,"transform":"translate(0.5%, 566%)"
            $(".div_count_icon"+i).css({"position":"absolute","width":width,
                                                    "float":"right","border":"0px solid white",
                                                   "height":"15%","top":top_icon,"left":left});
//,"transform":"translate(0%, 555%)"
           cell.div.css("opacity", 1);
           i++;
           });
        
            img.src = info.thumb;
    
             jQuery("#stack").append(cell.div);
    //first row for reflection
        if (y == 1)
        {
            cell.reflection = jQuery('<div class="cell fader view reflection" style="opacity: 0"></div>').width(CWIDTH).height(CHEIGHT);
            cell.reflection[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        
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
    

    function snowstack_init()
    {

        CHEIGHT = Math.round(window.innerHeight / 3.5);
        CWIDTH  = Math.round(CHEIGHT * 300 / 180);
        CXSPACING = CWIDTH + CGAP;
        CYSPACING = CHEIGHT + CGAP;

        jQuery("#mirror")[0].style.webkitTransform = "scaleY(-1.0) " + translate3d(0, - CYSPACING * 4 - 1, 0);
    }
    

    jQuery(window).load(function ()
    { 
        
        var page = 1;
        var loading = true;
    
        snowstack_init();
    
        flickr(function (images)
        {
            
            jQuery.each(images, snowstack_addimage);
            updateStack(1);
            loading = false;
        }, page);
        
        var keys = { left: false, right: false, up: false, down: false };
    
        var keymap = { 37: "left", 38: "up", 39: "right", 40: "down" };
        
        var keytimer = null;
        var scrolltimer = null;
        
        function updatekeys()
        { 
            
            var newcell = currentCell;
            if (keys.left)
            {
                /* Left Arrow */
                if (newcell >= 1)
                {
                    newcell -= 1;
                }
            }
    
    
            if (keys.right)
            {
                /* Right Arrow */
                if ((newcell + 1) < cells.length)
                {
                    newcell += 1;
                }
                else if (!loading)
                {
                    /* We hit the right wall, add some more */
                    page = page + 1;
                    loading = true;
                    flickr(function (images)
                    {
                        jQuery.each(images, snowstack_addimage);
                        loading = false;
                    }, page);
                }
            }
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
                }
            }
    
    
            if (scroll=='down')
            {
                /* scroll down */
                if ((newcell + 3) < cells.length)
                {
                    newcell += 3;
                }
                else if (!loading)
                {
                    /* We hit the right wall, add some more */
                    page = page + 1;
                    loading = true;
                    flickr(function (images)
                    {
                        jQuery.each(images, snowstack_addimage);
                        loading = false;
                    }, page);
                }
            }
           
    
            updateStack(newcell, magnifyMode);
        }
        
        var delay = 330;
    
        function keycheck()
        { 
         
            if (keys.left || keys.right || keys.up || keys.down)
            {
                if (keytimer === null)
                {
                    delay = 330;
                    var doTimer = function ()
                    {
                        updatekeys();
                        keytimer = setTimeout(doTimer, delay);
                        delay = 60;
                    };
                    doTimer();
                }
            }
            else
            {
                clearTimeout(keytimer);
                keytimer = null;
            }
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
            scrollcheck(scroll_type);
        });
    /* scroll check */
   
        function scrollcheck(scroll)
        {
            if (scroll=='up' || scroll=='down')
            {
                if (scrolltimer === null)
                 {
                    delay = 330;
                    var doTimer = function ()
                    {
                        updatescroll(scroll);
                     // scrolltimer = setTimeout(doTimer, delay);
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


        
        /* Limited keyboard support for now */
        window.addEventListener('keydown', function (e)
        {
            if (e.keyCode == 32)
            {
                /* Magnify toggle with spacebar */
                updateStack(currentCell, !magnifyMode);
            }
            else
            {
                keys[keymap[e.keyCode]] = true;
            }
            
            keycheck();
        });
        
        window.addEventListener('keyup', function (e)
        {
            keys[keymap[e.keyCode]] = false;
            keycheck();
        });
    });
    
    
   /*function flickr(callback, page)
    { 
        callback(images);
    }*/

      /* fetch(url).then(function(res){
            
            });*/

function flickr(callback, page)
    { 
    var url="http://127.0.0.1:8000/api/v1/blogs";
    $.getJSON(url, function(data) 
        {
           images=data['data'];
           callback(images);
                       
        });
         

      
    }


/*
  function flickr(callback, page)
    { 

  var url = "http://api.flickr.com/services/rest/?method=flickr.interestingness.getList&api_key=60746a125b4a901f2dbb6fc902d9a716&per_page=21&extras=url_o,url_m,url_s&page=" + page + "&format=json&jsoncallback=?";
  
      $.getJSON(url, function(data) 
        {
          
            var images = jQuery.map(data.photos.photo, function (item)
            {
             
                return {
               
                  thumb: item.url_s,
                  zoom: 'http://farm' + item.farm + '.static.flickr.com/' + item.server + '/' + item.id + '_' + item.secret + '.jpg',
                  link: 'http://www.flickr.com/photos/' + item.owner + '/' + item.id
                };
            });
    
            callback(images);
        });
    }

*/


    </script>
    
@endsection
