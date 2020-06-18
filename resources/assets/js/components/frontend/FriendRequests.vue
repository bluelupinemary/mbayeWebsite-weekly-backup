<style>
.round-image-large {
  border-radius: 50%;
  width: 150px;
  height: 150px;
  position: absolute;
  box-shadow: 0 0 23px 0px orange, 0 0 0px 0px gold;
}
#round-image-large1 {
  top: 5%;
  left: 5%;
}

#round-image-large2 {
  top: 5%;
  right: 1%;
}

#round-image-large3 {
  bottom: 5%;
}

#round-image-large4 {
  bottom: 5%;
  right: 1%;
}

#round-image-large5 {
  top: 30%;
  left: 40%;
}

.round-image-large img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

.round-image-small {
  border-radius: 50%;
  width: 90px;
  height: 90px;
  position: absolute;
  box-shadow: 0 0 12px 0px blue, 0 0 0px 0px red;
}

.round-image-small img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

#round-image-small1 {
  left: 10%;
  top: 28%;
}

#round-image-small2 {
  left: 30%;
  top: 12%;
}

#round-image-small3 {
  left: 67%;
  top: 23%;
}

#round-image-small4 {
  left: 10%;
  top: 58%;
}

#round-image-small5 {
  left: 85%;
  top: 39%;
}

#round-image-small6 {
  left: 26%;
  top: 74%;
}

#round-image-small7 {
  left: 47%;
  top: 61%;
}

#round-image-small8 {
  left: 80%;
  top: 62%;
}

#round-image-small9 {
  left: 60%;
  top: 74%;
}

#round-image-small10 {
  left: 55%;
  top: 4%;
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
    top: -59%;
    left: 4%;
}
</style>

<template>
  <section class="container-fluid" :v-if="renderComponent">
    <!-- Next and Previous buttons -->
    <span class="fa fa-caret-left"></span>
    <span class="fa fa-caret-right"></span>

    <!-- Next and Previous buttons -->

    <!-- 5 main images -->
    <div id="round-image-large1" class="round-image-large">
      <img :src="'/storage/profilepicture/' + this.users[0].photo" :key="this.users[0].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-large2" class="round-image-large">
      <img :src="'/storage/profilepicture/' + this.users[1].photo" :key="this.users[1].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-large3" class="round-image-large">
      <img :src="'/storage/profilepicture/' + this.users[2].photo" :key="this.users[2].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-large4" class="round-image-large">
      <img :src="'/storage/profilepicture/' + this.users[3].photo" :key="this.users[3].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-large5" class="round-image-large">
      <img :src="'/storage/profilepicture/' + this.users[4].photo" :key="this.users[4].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <!-- 5 main images -->

    <div id="round-image-small1" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[5].photo" :key="this.users[5].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small2" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[6].photo" :key="this.users[6].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small3" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[7].photo" :key="this.users[7].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small4" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[8].photo" :key="this.users[8].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small5" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[9].photo" :key="this.users[9].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small6" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[10].photo" :key="this.users[10].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small7" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[11].photo" :key="this.users[11].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small8" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[12].photo" :key="this.users[12].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small9" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[13].photo" :key="this.users[13].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
    <div id="round-image-small10" class="round-image-small">
      <img :src="'/storage/profilepicture/' + this.users[0].photo" :key="this.users[0].id" />
      <img src="front/images/accept-req.png" class="req-icon"/>
    </div>
  </section>
</template>

<script>
export default {
  props:{
            users:Object
          },
  data: function() {
    return {
      userList: [],
      page: 1,
      query: "",
      renderComponent:true
    };
  },
  mounted() {
    // this.fetchList();
    console.log(this.users);
  },
  updated(){
   this.userList = this.userList
  },
  computed:{
      users:function(){
        return this.userList
      }
    },
  methods: {
    fetchList() {
      const API = "http://127.0.0.1:8000/api/v1/users?page=1";
      fetch(API)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then((responseJson) => {
          this.userList = responseJson.data;
        })
        .catch((err) => alert(err));
    },
    acceptrequest(user_id) {
      axios
        .get("/acceptrequest/" + user_id)
        .then((response) => {
          alert(response.data);
          // this.checkfriendship(this.user_id);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    denyrequest(user_id) {
      axios
        .get("/denyrequest/" + user_id)
        .then((response) => {
          alert(response.data);
          // this.requestsent = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    nextPage() {
      const API = `http://127.0.0.1:8000/users?page=${this.page + 1}`;
      fetch(API)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then((responseJson) => {
          this.page = page + 1;
          this.users = responseJson.data;
        })
        .catch((err) => alert(err));
    },

    previousPage() {
      const API = `http://127.0.0.1:8000/users?page=${this.page - 1}`;
      fetch(API)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then((responseJson) => {
          this.page = this.page - 1;
          this.users = responseJson.data;
        })
        .catch((err) => alert(err));
    },


  },
};
</script>
