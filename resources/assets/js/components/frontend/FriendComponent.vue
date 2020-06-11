<template>
<div class="container">
<button class="btn btn-primary" v-on:click="unfriend(user_id)">Unfriend</button>
<button class="btn btn-danger" v-on:click="block(user_id)">Block</button>
</div>
</template>

<script>
export default {
    props:{
            user_id:Number
            },
    data:function() {
            return{

        }
    },
  mounted () {

  },
  methods:{
      unfriend(user_id){
        axios.get('/unfriend/'+this.user_id)
        .then((response) => {
            alert(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
      },
      block(user_id){
        axios.get('/block/'+this.user_id)
        .then((response) => {
            alert(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
      }
  }
}
</script>
