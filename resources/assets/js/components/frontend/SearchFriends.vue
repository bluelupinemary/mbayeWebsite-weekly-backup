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

#round-image-large6 {
  left: 10%;
  top: 28%;
}

#round-image-large7 {
  left: 30%;
  top: 12%;
}

#round-image-large8 {
  left: 67%;
  top: 23%;
}

#round-image-large9 {
  left: 10%;
  top: 58%;
}

#round-image-large10 {
  left: 85%;
  top: 39%;
}

#round-image-large11 {
  left: 26%;
  top: 74%;
}

#round-image-large12 {
  left: 47%;
  top: 61%;
}

#round-image-large13 {
  left: 80%;
  top: 62%;
}

#round-image-large14 {
  left: 60%;
  top: 74%;
}

#round-image-large15 {
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
    <div v-for="(user,index) in users">
    <div :id="'round-image-large' + index" class="round-image-large">
      <img :src="'/storage/profilepicture/' + user.photo" :key="user.id" />
      <a @click.prevent="sendrequest(user.id)" href=""><img src="front/images/add-user.png" class="req-icon"/></a>
    </div>
    </div>
    <div id="search-friends">
      <input type="text" placeholder="Enter Name to search" v-model="query" />
      <button @click.prevent="search">Search</button>
    </div>
  </section>
</template>

<script>

import Search from "./Search";
export default {
  name:"SearchFriends",
  data: function() {
    return {
      userList: [],
      page: 1,
      query: "",
      renderComponent:true,
      cursor:"pointer",
      disabled:false
    };
  },
  mounted() {
    this.fetchList();
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
    sendrequest(user_id){
      // alert(user_id);
        axios.get('/sendrequest/'+user_id)
        .then((response) => {
            alert(response.data);
            // this.checkfriendship(this.user_id);

        })
        .catch((error) => {
            console.log(error);
        })
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

    search() {
      this.renderComponent = false;
      const API = `http://127.0.0.1:8000/api/search/${this.query}`;
      debugger;
      fetch(API)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then((responseJson) => {
          this.userList=[];
          this.userList = responseJson;
        })
        .catch((err) => alert(err));
    },
  },
};
</script>