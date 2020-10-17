<template>
 <p class="button-number">{{this.sharecount}}</p>
</template>

<script>
export default {
   props:{
            blog_id:Number,
          },
    data:function() {
            return{
                sharecount: '0',
        }
      },
     methods: {
    countshares() {
      axios.get("/api/countgeneralblogshare/"+this.blog_id)
        .then((response) => {
          // alert(response.data);
          // debugger;
          this.sharecount = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted () {
    this.countshares();
    Echo.channel('generalblogsharecount'+this.blog_id)
            .listen('NewGeneralBlogShare',(e) => {
               this.countshares(this.blog_id);
            });
    
  }
}       
</script>
 