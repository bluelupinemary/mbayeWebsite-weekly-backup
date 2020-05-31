<template>
 <div class="blog-buttons">
    <div class="button-div hotIcon">
        <button><img src="/front/icons/hotNew.png"/></button>
        <div class="button-details">
            <p class="button-number">{{this.hotcount}}</p>
        </div>
    </div>
    <div class="button-div coolIcon">
        <button><img src="front/icons/coolIcon.png"/></button>
        <div class="button-details">
            <p class="button-number">{{this.coolcount}}</p>
        </div>
    </div>
    <div class="button-div shareIcon">
        <button>
            <img src="front/icons/share.png" alt="" width="40">
        </button>
        <div class="button-details">
            <p class="button-number">300k</p>
        </div>
    </div>
    <div class="button-div naffIcon">
        <button><img src="front/icons/naffPicked.png" width="40"/></button>
        <div class="button-details">
            <p class="button-number">{{this.naffcount}}</p>
        </div>
    </div>
    <div class="button-div commentsIcon">
        <button>
            <img src="front/icons/commentsNew.png" alt="" width="40">
        </button>
        <div class="button-details">
            <p class="button-number">{{this.commentcount}}</p>
        </div>
    </div>
</div>
</template>
<script>
export default {
   props:{
            blog_id:Number,
          },
    data:function() {
        return{
          hotcount: '',
          coolcount: '',
          naffcount: '',
          commentcount: '',
        }
      },
    mounted () {
    console.log("mounted");
    this.countemotions();
    this.countcomments();
     Echo.channel('blog'+this.blog_id)
      .listen('NewComment',(comment) => {
          this.countcomments();
      });
    Echo.channel('blogLike'+this.blog_id)
    .listen('NewEmotion',(like) => {
        console.log("listned");
        this.countemotions();
    });
  },
      methods: {
  countemotions() {
   axios.post('/api/countemotions', {
       blog_id: this.blog_id,
   })
         .then((response) => {
               this.hotcount= response.data.hot;
               this.coolcount= response.data.cool;
               this.naffcount= response.data.naff;

             })
         .catch(function (error) {
           console.log(error);
         });  
 },

 countcomments() {
   axios.post('/api/countcomments', {
       blog_id: this.blog_id,
   })
         .then((response) => {
               this.commentcount= response.data;
             })
         .catch(function (error) {
           console.log(error);
         });  
 }
  },
}       
</script>
 