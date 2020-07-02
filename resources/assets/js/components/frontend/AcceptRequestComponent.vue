
<template>
  <section class="container-fluid">
    <!-- Next and Previous buttons -->
    <span class="fa fa-caret-left"></span>
    <span class="fa fa-caret-right"></span>

    <!-- Next and Previous buttons -->
    <div v-for="(user,index) in users">
    <div :id="'round-image-large' + index" >
      <img :src="'/storage/profilepicture/' + user.photo" :key="user.id" id="user-img"/>
      <!-- <a href=""><i class="fas fa-user-plus req-icon"></i></a> -->
      <a @click.prevent="acceptrequest(user.id)" href=""><i class="fas fa-user-plus req-icon"></i></a>
      <a @click.prevent="denyrequest(user.id)" href=""><i class="fas fa-user-minus req-icon"></i></a>

    </div>
    </div>
  </section>
</template>

<script>
export default {
    props:{
            auth:Object,
            },
    data:function() {
            return{
              // requests:{},
              users:{},
        }
    },
  mounted () {
    this.fetchrequests();
    Echo.channel('App.User.'+this.auth.id)
            .listen('FriendRequest',(friendship) => {
                //this.comments.push(event.comment);
                console.log(friendship);
                this.fetchrequests();
                // this.comments.unshift(comment);
                
            });
    // console.log(this.auth);
    // this.fetchrequests();
    //  this.checkfriendship(this.user_id);
    // alert("mounted");
  },
  methods:{
      acceptrequest(user_id){
        axios.get('/acceptrequest/'+user_id)
        .then((response) => {
            // alert(response.data);
            // this.checkfriendship(this.user_id);
             this.fetchrequests();
        })
        .catch((error) => {
            console.log(error);
        })
      },
      denyrequest(user_id){
        axios.get('/denyrequest/'+user_id)
        .then((response) => {
          this.fetchrequests();
            // alert(response.data);
            // this.requestsent = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
      },
      fetchrequests(){
        axios.get('/fetchrequests/')
        .then((response) => {
            // alert(response.data);
            this.users = response.data.data;
          //  this.getuser(response.data.data)
        })
        .catch((error) => {
            console.log(error);
        })
      },
      // getuser(data){
      //   this.users = ''
      //    data.forEach(element => {
      //          axios.get(`/getuser/${element.sender_id}`)
      //          .then((response)=>{
      //           //  debugger
      //               let _users = [...this.users, response.data];
      //               this.users = _users;
      //          })
      //       });
      // }
  }
}
</script>
