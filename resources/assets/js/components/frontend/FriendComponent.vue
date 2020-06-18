<style>
.round-image-large {
  border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}
#round-image-large0 {
  top: 5%;
  left: 45%;
   border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}
#round-image-large1 {
  top: 5%;
  left: 5%;
   border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}

#round-image-large2 {
  top: 5%;
  right: 1%;
   border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}

#round-image-large3 {
  bottom: 5%;
   border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}

#round-image-large4 {
  bottom: 5%;
  right: 1%;
   border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}

#round-image-large5 {
  top: 30%;
  left: 40%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px blue, 0 0 0px 0px red;
}

[id^="round-image-large"] #user-img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
   border-radius: 50%;
  position: absolute;
  box-shadow: 0 0 12px 0px blue, 0 0 0px 0px red;
}
[id^="round-image-large"] a{
  border-radius: 50%;
}

.round-image-small {
  border-radius: 50%;
  width: 90px;
  height: 90px;
  position: absolute;
  
   border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}


#round-image-large6 {
  left: 10%;
  top: 28%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px blue, 0 0 0px 0px red;
}

#round-image-large7 {
  left: 30%;
  top: 12%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px blue, 0 0 0px 0px red;
}

#round-image-large8 {
  left: 67%;
  top: 23%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px blue, 0 0 0px 0px red;
}

#round-image-large9 {
  left: 10%;
  top: 58%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}

#round-image-large10 {
  left: 85%;
  top: 39%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}

#round-image-large11 {
  left: 26%;
  top: 74%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}

#round-image-large12 {
  left: 47%;
  top: 61%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}

#round-image-large13 {
  left: 80%;
  top: 62%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}

#round-image-large14 {
  left: 60%;
  top: 74%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}

#round-image-large15 {
  left: 55%;
  top: 4%;
   border-radius: 50%;
  width: 80px;
  height: 80px;
  position: absolute;
  box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;
}
#search-friends {
  display: inline-block;
  position: absolute;
  left: 40%;
  bottom: 3%;
  
}
.req-icon{
  width: 30px !important;
    position: relative;
    height: 30px !important;
    background-color: aliceblue;
    top: calc(50% - 10px) !important;
    border-radius: 50%;
    left: 4%;
}

.arrow-left{
  position: absolute;
  top: calc(50% - 30px);
  left: 1%;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: white;
}
.arrow-right{
  position: absolute;
  top: calc(50% - 30px);
  right: 1%;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: white;
}
</style>
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
        <a @click.prevent="unfriend(user.id)" href=""><i class="fas fa-user-plus req-icon"></i></a>
      <a @click.prevent="block(user.id)" href=""><i class="fas fa-user-minus req-icon"></i></a>
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
      }
  }
}
</script>
