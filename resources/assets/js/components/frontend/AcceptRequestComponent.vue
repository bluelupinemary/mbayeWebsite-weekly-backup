<template>
    <div class="container">
    <button class="btn btn-primary" v-on:click="acceptrequest(user_id)">Accept Request</button>
    <button class="btn btn-danger" v-on:click="denyrequest(user_id)">Deny Request</button>
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
    //  this.checkfriendship(this.user_id);
  },
  methods:{
      acceptrequest(user_id){
        axios.get('/acceptrequest/'+this.user_id)
        .then((response) => {
            alert(response.data);
            // this.checkfriendship(this.user_id);

        })
        .catch((error) => {
            console.log(error);
        })
      },
      denyrequest(user_id){
        axios.get('/denyrequest/'+this.user_id)
        .then((response) => {
            alert(response.data);
            // this.requestsent = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
      }
  }
}
</script>
