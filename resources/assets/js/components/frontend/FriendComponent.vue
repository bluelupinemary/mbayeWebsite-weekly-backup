
<template>
 <section class="container-fluid">
    <!-- Next and Previous buttons -->
    <!-- <div class="arrow-left"><img src="front/images/arrow-left.png"/></div>
    <div class="arrow-right"><img src="front/images/arrow-right.png"/></div> -->

    <!-- Next and Previous buttons -->

    <!-- 5 main images -->
    <div v-for="(user,index) in users">
    <div :id="'round-image-large' + index" class="ani-rolloutUse" >
      <img :src="'/storage/profilepicture/' + user.photo" :key="user.id" id="user-img"/>
        <!-- <a @click.prevent="unfriend(user.id)" href=""><i class="fas fa-user-plus req-icon"></i></a> -->
      <!-- <a @click.prevent="block(user.id)" href=""><i class="fas fa-user-minus req-icon"></i></a> -->
      <a @click.prevent="groupfriend(user.id)" href=""><i class="fas fa-users req-icon"></i></a>
      <a @click.prevent="ungroupfriend(user.id)" href=""><i class="fas fa-user req-icon"></i></a>
    </div>
    </div>
  </section>
</template>

<script>
export default {
    props:{
            auth:Object
            },
    data:function() {
            return{
                users:{},

        }
    },
  mounted () {
        this.fetchfriends();
        Echo.channel('App.User.'+this.auth.id)
            .listen('RequestAccepted',(friendship) => {
                //this.comments.push(event.comment);
                console.log(friendship);
                this.fetchfriends();
                // this.comments.unshift(comment);
                
            });
  },
  methods:{
      unfriend(user_id){
        axios.get('/unfriend/'+user_id)
        .then((response) => {
            alert(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
      },
        fetchfriends(){
        axios.get('/fetchfriends/')
        .then((response) => {
            this.users = response.data.data;
            // alert(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
      },
      block(user_id){
        axios.get('/block/'+user_id)
        .then((response) => {
            alert(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
      },
       groupfriend(user_id) {
          axios.post('/groupfriend/', {
            id: user_id,
            name: "friends",
          })
          .then((response) => {
           alert(response.data);
          })
          .catch((error) => {
            console.log(error);
          });
        },

        ungroupfriend(user_id) {
          alert('helloo');
          axios.post('/ungroupfriend/', {
            id: user_id,
            name: "friends",
          })
          .then((response) => {
           alert(response.data);
          })
          .catch((error) => {
            console.log(error);
          });
        },
  }
}
</script>
