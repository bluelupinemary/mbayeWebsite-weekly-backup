<template>
  <section class="container-fluid">
    <!-- View 2 starts from here  -->
    <div v-if="searched">
        
        <!-- Next and Previous buttons -->
        <div class="arrow-left" @click="previousPage(page)" v-if="page > 1 && page <= last_page">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
        <div class="arrow-right" @click="nextPage(page)" v-if="page < last_page">
            <i class="fas fa-chevron-circle-right"></i>
        </div>
        <!-- Next and Previous buttons -->

        <!-- 5 main images -->
      	<div v-for="(user,index) in users" class="main-friends">
			<button class="close-view" @click.prevent="closeView('round-image-large' + index)">
				<i class="fas fa-times-circle"></i>
			</button>
			<div :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse" @click="handleImgClick('round-image-large' + index, user.id)">
				<img v-if="user.photo && user.photo.includes('cropped')" :src="'/storage/profilepicture/crop/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter"/>
				<img v-else-if="user.photo == null" :src="'/storage/profilepicture/default.png'" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter"/>
				<img v-else :src="'/storage/profilepicture/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter"/>
				
				<div class="friend-details">
					<a class="friend-icon view-icon tooltips left" style="" @click.prevent="viewProfile(user.id)">
						<span>View Profile</span>
						<i class="fa fa-eye"></i>
					</a>
					<a class="friend-icon add-friend-icon tooltips right" @click.prevent="sendrequest('round-image-large' + index, user.id)">
						<span>Send Friend Request</span>
						<i class="fa fa-plus"></i>
					</a>
					<!-- <a class="friend-icon add-friend-icon" v-else @click.prevent="sendrequest(user.id)">
						<i class="fa fa-plus"></i>
					</a> -->
                    <div class="friend-info">
                        <p class="friend-name">{{user.first_name}} {{user.last_name}}</p>
                        <p class="friend-address">{{user.address}}</p>

                        <p class="no_of_earthlings">Earthlings: {{user.earthlings_count}}</p>
                    </div>
				</div>
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
import Swal from 'sweetalert2'

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
	jQuery(document).on('keyup',function(evt) {
		if (evt.keyCode == 27) {
			$('.main-friends').removeClass('with-background');
			$('.friends').removeClass('zoom-in');
			$('.friend-details, .close-view').hide();
		}
	});
  },
  computed: {
    users: function() {
      return this.userList.slice(0, 16);
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
    handleImgClick(id, user_id) {
		// var target = event.target;
		console.log('view');
		$('#'+id).closest('div.main-friends').addClass('with-background');
		$('#'+id).addClass('zoom-in');

		axios
        .get("/hasSentFriendRequest/" + user_id)
        .then(response => {
			// console.log('sent request:' +response.data);
			if(response.data == 1) {
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').empty();
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').append(`
					<span>Cancel Friend Request</span>
					<i class="fas fa-minus"></i>
				`);
			} else if(response.data == 2) {
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').empty();
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').append(`
					<span class="friends-tooltip">Friends</span>
					<i class="fas fa-user-friends"></i>
                `);
			}
        });
		
		$('#'+id+'.zoom-in').on("webkitTransitionEnd transitionend", function(){
			$('#'+id+' .friend-details').css('display', 'flex');
			$('#'+id).closest('div.main-friends').find('.close-view').css('display', 'flex');
		});
		
		// target.closest('div.main-friends').classList.add("with-background");
		// target.closest('div.friends').classList.add("zoom-in");
		// target.closest('.friend-icon').style.display='block';
		//   this.selectedUser = user;
		//   this.activeClass = "show"

	},
	closeView(id) {
		console.log('close');
		$('#'+id).closest('div.main-friends').removeClass('with-background');
		$('#'+id).removeClass('zoom-in');
		$('#'+id+' .friend-details').css('display', 'none');
		$('#'+id).closest('div.main-friends').find('.close-view').css('display', 'none');
	},
	// returnFriend(event) {
	// 	var target = event.target;

	// 	target.closest('div.main-friends').classList.remove("with-background");
	// 	target.closest('div.friends').classList.remove("zoom-in");
	// },
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
		  console.log(this.userList);
        })
        .catch(err => alert(err));
    },
    sendrequest(id, user_id) {
	  // alert(user_id);
	  const Swal = require('sweetalert2')
      axios
        .get("/sendrequest/" + user_id)
        .then(response => {
			// alert(response.data);
			if(response.data.status) {
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').empty();
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').append(`
					<span>Cancel Friend Request</span>
					<i class="fas fa-minus"></i>
				`);
			} else {
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').empty();
				$('#'+id).closest('div.main-friends').find('.add-friend-icon').append(`
					<span>Send Friend Request</span>
					<i class="fa fa-plus"></i>
				`);
			}

			Swal.fire({
				title: '<span class="success">Success!</span>',
				text: response.data.message,
				imageUrl: '../../front/icons/alert-icon.png',
				imageWidth: 80,
				imageHeight: 80,
				imageAlt: 'Mbaye Logo',
				padding: '1rem',
				background: 'rgb(8 64 147 / 89%)'
			});
          // this.checkfriendship(this.user_id);
        })
        .catch(error => {
          console.log(error);
        });
    },
	viewProfile(id) {
		window.location.href = '/user_dashboard/'+id;
	},
	hasSentFriendRequest(id) {
		axios
        .get("/hasSentFriendRequest/" + id)
        .then(response => {
			console.log(id, response.data);
			return response.data;
        })
        .catch(error => {
          console.log(error);
        });
	},
    search() {
      this.renderComponent = false;
      this.page = 1;
      const API = `/search_friends/?q=${this.query}&page=${this.page}`;
      fetch(API)
        .then(response => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then(responseJson => {
          this.userList = [];
          this.userList = responseJson.data;
          console.log(responseJson);
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
      const API = `/search_friends?q=${this.query}&page=${page + 1}`;
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
      const API = `/search_friends?q=${this.query}&page=${page - 1}`;
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