
<template>
	<section class="container-fluid">
		<!-- Next and Previous buttons -->
        <div class="arrow-left" @click="previousPage(page)" v-if="page > 1 && page <= last_page">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
        <div class="arrow-right" @click="nextPage(page)" v-if="page < last_page">
            <i class="fas fa-chevron-circle-right"></i>
        </div>
        <!-- Next and Previous buttons -->

        <!-- 5 main images -->
		<div v-if="users.length" >
      	<div v-for="(user,index) in users" class="main-friends">
			<button class="close-view" @click.prevent="closeView('round-image-large' + index)">
				<i class="fas fa-times-circle"></i>
			</button>
			<div :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse">
				<img v-if="user.photo && user.photo.includes('cropped')" :src="'/storage/profilepicture/crop/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				<img v-else-if="user.photo == null" :src="'/storage/profilepicture/default.png'" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				<img v-else :src="'/storage/profilepicture/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				
				<div class="friend-details">
					<a class="friend-icon view-icon tooltips left" style="" @click.prevent="viewProfile(user.id)">
						<span>View Profile</span>
						<i class="fa fa-eye"></i>
					</a>
					<a class="friend-icon decline-friend-icon tooltips right" @click.prevent="denyrequest(user.id)"
					@mouseover="addBlackhole()"
    				@mouseleave="removeBlackhole()">
						<span>Decline Friend Request</span>
						<img :src="'/front/icons/blackhole-icon.png'" alt="">
					</a>
					<a class="friend-icon add-friend-icon tooltips top" @click.prevent="acceptrequest(user.id)">
						<span>Accept Friend Request</span>
						<i class="fa fa-plus"></i>
					</a>
					<div class="friend-info">
						<p class="friend-name">{{user.first_name}} {{user.last_name}}</p>
						<p class="friend-address">{{user.address}}</p>

						<p class="no_of_earthlings">Earthlings: {{user.earthlings_count}}</p>
					</div>
				</div>
			</div>
      	</div>
		</div>
		<div v-else class="no-friend-request">
			<p>No Friend Request.</p>
		</div>

		<div id="search-friends">
            <div id="search-friends-view2">
                <h1 id="search-friends-view2-heading" style="text-align:center">
                    Recruit
                    <br />Earthlings
                </h1>
                <!-- <div class="search-form">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Enter Name to search" v-model="query">
                    <button type="submit" class="btn search-btn" @click.prevent="search">Search</button>
                </div> -->
            </div>
        </div>
	</section>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    props:{
            auth:Object,
            },
    data:function() {
        return{
			// requests:{},
			users:{},
			userList: [],
			page: 1,
			query: "",
			searched: false,
			cursor: "pointer",
			next: false,
			last_page: '',
			showDialog: false,
			selectedUser: {},
			activeClass:"hide",
			declinedRequest: false
        }
    },
  	mounted () {
		this.fetchrequests();
		Echo.channel('App.User.'+this.auth.id)
		.listen('FriendRequest',(friendship) => {
			//this.comments.push(event.comment);
			// console.log(friendship);
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
			const Swal = require('sweetalert2')

			axios.get('/acceptrequest/'+user_id)
			.then((response) => {
				// alert(response.data);
				// this.checkfriendship(this.user_id);
				
				this.closeAllView();
				this.users = [];
				this.fetchrequests();

				Swal.fire({
					title: '<span class="success">Success!</span>',
					text: response.data,
					imageUrl: '../../front/icons/alert-icon.png',
					imageWidth: 80,
					imageHeight: 80,
					imageAlt: 'Mbaye Logo',
					width: '30%',
					padding: '1rem',
					background: 'rgb(8 64 147 / 89%)'
				});				
			})
			.catch((error) => {
				console.log(error);
			})
		},
		denyrequest(user_id){
			const Swal = require('sweetalert2')
			this.declinedRequest = true;
			$('.tooltips span').hide();
			$('button.close-view').hide();

			axios.get('/denyrequest/'+user_id)
			.then((response) => {
				var $this = this;
				setTimeout(function(){
					$('canvas').fadeOut(500, function() {
						$( this ).remove();
						$this.closeAllView();
						$this.users = [];
						$this.fetchrequests();
						// $('.friends').css('transform', 'translate(-50%, -50%)');

						Swal.fire({
							title: '<span class="success">Success!</span>',
							text: response.data,
							imageUrl: '../../front/icons/alert-icon.png',
							imageWidth: 80,
							imageHeight: 80,
							imageAlt: 'Mbaye Logo',
							width: '30%',
							padding: '1rem',
							background: 'rgb(8 64 147 / 89%)'
						});	
					});
				}, 3000);
				
				// alert(response.data);
				// this.requestsent = response.data;
			})
			.catch((error) => {
				console.log(error);
			})
		},
		fetchrequests(){
			axios.get(`/fetchrequests?page=${this.page}`)
			.then((response) => {
				// console.log(response);
				this.users = response.data.data;
				this.page = response.data.current_page;
          		this.last_page = response.data.last_page;
			//  this.getuser(response.data.data)
			})
			.catch((error) => {
				console.log(error);
			})
		},
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
			this.declinedRequest = false;
			$('#'+id).closest('div.main-friends').addClass('with-background');
			$('#'+id).addClass('zoom-in');
		
			$('#'+id+'.zoom-in').on("webkitTransitionEnd transitionend", function(){
				$('#'+id+' .friend-details').css('display', 'flex');
				$('#'+id).closest('div.main-friends').find('.close-view').css('display', 'flex');
			});
			blackhole('.with-background', 255, 2.5);
		},
		closeView(id) {
			console.log('close');
			$('#'+id).closest('div.main-friends').removeClass('with-background');
			$('#'+id).removeClass('zoom-in');
			$('#'+id+' .friend-details').css('display', 'none');
			$('#'+id).closest('div.main-friends').find('button.close-view').css('display', 'none');
		},
		closeAllView() {
			$('.main-friends').removeClass('with-background');
			$('.friends').removeClass('zoom-in');
			$('.friends').removeClass('rotate');
			$('.friend-details, button.close-view').hide();
			$('canvas').remove();
		},
		viewProfile(id) {
			window.location.href = '/user_dashboard/'+id;
		},
		nextPage(page) {
			axios.get(`/fetchrequests?page=${page + 1}`)
			.then((response) => {
				// console.log(response);
				this.page = page + 1;
				this.users = response.data.data;
			//  this.getuser(response.data.data)
			})
			.catch((error) => {
				console.log(error);
			})
		},

		previousPage(page) {
			axios.get(`/fetchrequests?page=${page - 1}`)
			.then((response) => {
				// console.log(response);
				this.page = page - 1;
				this.users = response.data.data;
			//  this.getuser(response.data.data)
			})
			.catch((error) => {
				console.log(error);
			})
		},
		addBlackhole() {
			if(!this.declinedRequest) {
				$('canvas').fadeIn(500);
			}
		},
		removeBlackhole() {
			if(!this.declinedRequest) {
				$('canvas').fadeOut(500);
			}
		}
  }
}
</script>
