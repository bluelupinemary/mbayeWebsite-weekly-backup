$(document).ready(function(){	


    // for search functionality
      $(".home-input").keyup(function(){
       
              if($(".home-input").val().length>0){ 
              $.ajax({
               type: "post",
               url: "http://localhost/InoxArabia/index.php/search/execute_search",
               cache: false,    
               data:'search='+$(".home-input").val(),
               success: function(response){
                $('#finalResult').html("");
                var obj = JSON.parse(response);
                if(obj.length>0){
                 try{
                  var items=[];  
                  $.each(obj, function(i,val){    
              var site_url="http://localhost/InoxArabia/index.php/";
              var page_url=site_url+val.var_link;
              var aTag = document.createElement('a');
              aTag.setAttribute('href',page_url);
              aTag.setAttribute('class','search_items_a');
              aTag.innerText = val.var_keyword;
              items.push(aTag); 
              items.push("</br>"); 
    
                  }); 
                  $('#finalResult').append.apply($('#finalResult'), items);
                 }catch(e) {  
                  alert('EXCEPTION WHILE REQUEST..');
                 }  
                }else{
                 $('#finalResult').html($('<li/>').text("NO DATA FOUND"));  
                }  
               
            },
            error: function(){      
             alert('ERROR WHILE REQUEST..');
            }
           });
           }
           return false;
            });



            $("*", "body").not(".home-input").click(function() {
               // alert('haha');
            });
            //for closing list elements when focus is  out
        $(".home-input").focusout(function(){ 
           
               // $('#finalResult').html("");
                $(".home-input").html("");
           
              });

              $('body').click(function(){
                
                if($(".home-input").val().length>0){     $("#finalResult").html("");    
              }
              else{

              }
              });
        });
