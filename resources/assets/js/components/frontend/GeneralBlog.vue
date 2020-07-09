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
            
            },
    data:function() {
            return{
                // blogs: [],
        }
    },
  mounted () {
    this.fetchblogs();
     Echo.channel('general_blogs')
            .listen('GeneralBlogEvent',(response) => {
                console.log(response.data);
                    this.fetchblogs();
            });

    
    
  },
  methods:{
    fetchblogs() {
        var images = [];  
        var page = 1;
        var loading = true;
        /* Calling API for fetching images */
          let url = 'http://127.0.0.1:8000';
        var url_api=url+"/api/v1/bloggeneral?page="+page
      
            page=1;
            $.getJSON(url_api, function fetchfromdb(data) 
            {
              images=data['data'];
              console.log(images);
              page=data['meta']['current_page'];
              last_page=data['meta']['last_page'];
              Total_pages=(data['meta']['total']/25);
              Total_pages=parseInt(Total_pages);
              Total_count=data['meta']['total'];
              snowstack_init();
              jQuery.each(images, snowstack_addimage);
              updateStack(1);
            loading = false;
          
            });
        
            
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
                      
                
                        var url_api=url+"/api/v1/bloggeneral?page="+page
                        $.getJSON(url_api, function(data) 
                        {
    
                        images=data['data'];
                      
                  
                      if((newcell + 3) != images.length)
                              jQuery.each(images, snowstack_addimage);
                    
                  
                        });
                    
        
                  
                }
                }
              
                //if((newcell + 3)!=images.length)
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
    },
  }
}

</script>
