<template>
  <section class="container-fluid">
    <!-- View 2 starts from here  -->
    <div v-if="searched">
        <!-- Modal -->
        <div  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" v-bind:class="[activeClass, 'modal', 'fade']" style="background-color:rgba(0, 0, 0, 0.6)">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              <div class="modal-body" style="display:flex;justify-content:center;align-item:center">
                <img
				v-if="selectedUser.photo && selectedUser.photo.includes('cropped')" :src="'/storage/profilepicture/crop/'+selectedUser.photo"
				style="height:400px;width:400px;z-index:1;border-radius:50%; pointer-events:all; box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;"
				/>
				<img
				v-else-if="selectedUser.photo == null" :src="'/storage/profilepicture//default.png'"
				style="height:400px;width:400px;z-index:1;border-radius:50%; pointer-events:all; box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;"
				/>
				<img
				v-else :src="'/storage/profilepicture/'+selectedUser.photo"
				style="height:400px;width:400px;z-index:1;border-radius:50%; pointer-events:all; box-shadow: 0 0 12px 0px green, 0 0 0px 0px yellow;"
				/>
				<a @click="viewProfile()" style="position: absolute;top: 46%;left: 12%;padding: 5px;pointer-events: all;color: blue;cursor: pointer;z-index: 2;height: auto;">
				<i class="fa fa-eye req-icon1"></i>
				</a>
				<a
				@click.prevent="sendrequest(selectedUser.id)" style="position: absolute;top: 46%;right: 12%;padding: 5px;pointer-events: all;color: blue;cursor: pointer;z-index: 2;height: auto;">
				<i class="fa fa-plus req-icon2"></i>
				</a>
            </div>
          </div>
        </div>
      <!-- material dialog -->
      <!-- <md-dialog :md-active.sync="showDialog">
        <md-avatar class="md-avatar-icon md-large" style="width:400px;height:400px;">
          <img
            :src="'/storage/profilepicture/'+selectedUser.photo"
            style="z-index:1;border-radius:50%"
          />

          <md-button
           @click="viewProfile()"
            style="   position: absolute;
                      right: -5%;
                      padding: 3px;
                      pointer-events: all;
                      color: blue;
                      cursor: pointer;
                      z-index: 2;
                      height:auto;
                      padding:5px"
          >
            <i class="fa fa-eye req-icon1"></i>
          </md-button>

          <md-button
           @click.prevent="sendrequest()"
            style="      position: absolute;
                        left: -3%;
                        padding: 3px;
                        pointer-events: all;
                        color: blue;
                        cursor: pointer;
                        z-index: 2;
                        height:auto;
                        padding:5px"
          >
            <i class="fa fa-plus req-icon2"></i>
          </md-button>
          <span 
          class="md-title"
          style="      position: absolute;
                        padding: 3px;
                        pointer-events: all;
                        color: white;
                        z-index: 2;
                        padding:5px;
                        font-size:28px;
                        font-weight:600"
          >
            {{selectedUser.first_name+" "+selectedUser.last_name}}
          </span>
          <span 
          class="md-title"
          style="      position: absolute;
                        padding: 3px;
                        pointer-events: all;
                        color: white;
                        z-index: 2;
                        padding:5px;"
          >
            {{selectedUser.address}}
          </span>
        </md-avatar>
      </md-dialog> -->

      <!-- end of material dialog -->

      <a
        @click="backSearched()"
        style="color:white;cursor:pointer; top:20px; left:20px; position:absolute; font-size:20px"
      >
        <i @click="searched()" class="fa fa-arrow-left"></i>
        {{" "}}Go Back
      </a>
      <!-- Next and Previous buttons -->
      <div class="arrow-left" @click="previousPage(page)" v-if="page > 1 && page <= last_page">
        <i class="fas fa-chevron-circle-left"></i>
      </div>
      <div class="arrow-right" @click="nextPage(page)" v-if="page < last_page">
        <i class="fas fa-chevron-circle-right"></i>
      </div>

      <!-- Next and Previous buttons -->

      <!-- 5 main images -->
      <div v-for="(user,index) in users">
        
        <div :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse" @click="handleImgClick(user)">
			<img v-if="user.photo && user.photo.includes('cropped')" :src="'/storage/profilepicture/crop/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter"/>
			<img v-else-if="user.photo == null" :src="'/storage/profilepicture/default.png'" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter"/>
          	<img v-else :src="'/storage/profilepicture/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter"/>
          <!-- <a @click.prevent="sendrequest(user.id)" href>
            <i class="fas fa-user-plus req-icon"></i>
          </a>
          <a href>
            <i class="fa fa-ban req-icon"></i>
          </a> -->
        </div>
      </div>
      <div id="search-friends">
        <div id="search-friends-view2">
			<h1 id="search-friends-view2-heading" style="text-align:center">
				Find
				<br />Earthlings
			</h1>
			<div class="search-form">
				<input type="text" class="form-control" name="search" autocomplete="off" placeholder="Enter Name to search" v-model="query">
				<button type="submit" class="btn search-btn" @click.prevent="search">Search</button>
			</div>
        </div>
      </div>
    </div>
    <!-- View 2 ends from here  -->

    <!-- View 1 starts from here  -->
    <div v-if="!searched">
      <div id="search-friends-view1">
        <h1 id="search-friends-view1-heading">Find Earthlings</h1>
		<div class="search-form">
			<input type="text" class="form-control" name="search" autocomplete="off" placeholder="Enter Name to search" v-model="query">
			<button type="submit" class="btn search-btn" @click.prevent="search">Search</button>
		</div>
      </div>
    </div>
    <!-- View 2 ends here  -->
  </section>
</template>

<script>
export default {
  name: "SearchFriends",
  data: function() {
    return {
      userList: [],
      page: 1,
      query: "",
      searched: false,
      cursor: "pointer",
      next: false,
      last_page: '',
      showDialog: false,
      selectedUser: {},
      activeClass:"hide"
    };
  },
  mounted() {
	// var url = $('meta[name="url"]').attr('content');
	// this.fetchList();
  },
  computed: {
    users: function() {
      return this.userList.slice(0, 15);
    }
  },
  methods: {
    randomBoxShadow() {
        var color = Math.floor(Math.random()*16777215).toString(16);
        // console.log({
        //     'color': '#'+color,
        //     'box-shadow': '0 0 12px 0 #'+color
        // });
        return {
            'color': '#'+color,
            'box-shadow': '0 0 12px 0 #'+color
        };
    },
    handleImgClick(user) {
      this.selectedUser = user;
      this.activeClass = "show"
    },
    backSearched() {
      this.searched = false;
      this.userList = [];
    },
    fetchList() {
      const API = `/api/v1/users?page=${this.page}`;
      fetch(API)
        .then(response => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then(responseJson => {
          if (responseJson.links.last !== responseJson.links.first) {
            this.next = true;
          }
		  this.userList = responseJson.data;
		//   console.log(this.userList);
        })
        .catch(err => alert(err));
    },
    sendrequest() {
      // alert(user_id);
      axios
        .get("/sendrequest/" + this.selectedUser.id)
        .then(response => {
          alert(response.data);
          // this.checkfriendship(this.user_id);
        })
        .catch(error => {
          console.log(error);
        });
    },

    search() {
      this.renderComponent = false;
      this.page = 1;
      const API = `/api/search/?q=${this.query}&page=${this.page}`;
      fetch(API)
        .then(response => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then(responseJson => {
          this.userList = [];
          this.userList = responseJson.data;
          this.page = responseJson.current_page;
          this.last_page = responseJson.last_page;
          this.searched = true;
          if (
            responseJson.links &&
            responseJson.links.last !== responseJson.links.first
          ) {
            this.next = true;
          }
        })
        .catch(err => alert(err));
    },

    nextPage(page) {
      const API = `/api/search?q=${this.query}&page=${page + 1}`;
      fetch(API)
        .then(response => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then(responseJson => {
          this.page = page + 1;
        //   if (responseJson.links.last !== responseJson.links.first) {
        //     this.next = true;
        //   }
        //   debugger;
          this.userList = responseJson.data;
        })
        .catch(err => alert(err));
    },

    previousPage(page) {
      const API = `/api/search?q=${this.query}&page=${page - 1}`;
      fetch(API)
        .then(response => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then(responseJson => {
          this.page = this.page - 1;
        //   if (responseJson.links.last !== responseJson.links.first) {
        //     this.next = true;
        //   }
          this.userList = responseJson.data;
        })
        .catch(err => alert(err));
    }
  }
};
</script>