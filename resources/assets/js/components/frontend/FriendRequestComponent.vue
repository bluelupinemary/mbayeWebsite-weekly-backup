<template>
<div class="container">
<button class="btn btn-primary" v-if="this.requestsent == 0" v-on:click="sendrequest(user_id)">Send Request</button>
<button class="btn btn-danger" v-else-if="this.requestsent == 1" v-on:click="sendrequest(user_id)">Cancle Request</button>
</div>
</template>

<script>
export default {
    props:{
            user_id:Number
            },
    data:function() {
            return{
                requestsent: '',
        }
    },
  mounted () {
    //   alert("mounted");
     this.checkfriendship(this.user_id);
  },
  methods:{
      sendrequest(user_id){
        axios.get('/sendrequest/'+this.user_id)
        .then((response) => {
            // alert(response.data);
            this.checkfriendship(this.user_id);

        })
        .catch((error) => {
            console.log(error);
        })
      },
      checkfriendship(user_id){
        axios.get('/checkfriendship/'+this.user_id)
        .then((response) => {
            // alert(response.data);
            this.requestsent = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
      }
  }
}
</script>
