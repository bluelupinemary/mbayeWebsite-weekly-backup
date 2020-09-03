
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
      	<div v-for="(user,index) in users" :class="getMainClass(index)" :key="index">
			<div v-if="index == 0" :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse zoom-in">
				<img v-if="user.photo && user.photo.includes('cropped')" :src="'/storage/profilepicture/crop/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				<img v-else-if="user.photo == null" :src="'/storage/profilepicture/default.png'" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				<img v-else :src="'/storage/profilepicture/'+ user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				
				<div class="friend-details" style="display: block;">
					<a class="friend-icon view-icon tooltips left" style="" @click.prevent="viewProfile(user.id)">
						<span>View Profile</span>
						<i class="fa fa-eye"></i>
					</a>
					<a class="friend-icon decline-friend-icon tooltips right" @click.prevent="unfriend(user.id)" 
					@mouseover="addBlackhole()"
    				@mouseleave="removeBlackhole()">
						<span>Unfriend</span>
						<img :src="'/front/icons/blackhole-icon.png'" alt="">
					</a>
					<a class="friend-icon add-friend-icon tooltips top">
						<span>Chat Friend</span>
						<img :src="'/front/icons/chat-icon.png'" alt="">
					</a>
					<div class="friend-info">
						<p class="friend-name">{{user.first_name}} {{user.last_name}}</p>
						<p class="friend-address">{{user.address}}</p>

						<p class="no_of_earthlings">Earthlings: {{user.earthlings_count}}</p>
					</div>
				</div>
			</div>
			<div v-else :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse">
				<img v-if="user.photo && user.photo.includes('cropped')" :src="'/storage/profilepicture/crop/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				<img v-else-if="user.photo == null" :src="'/storage/profilepicture/default.png'" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				<img v-else :src="'/storage/profilepicture/' + user.photo" :key="user.id" id="user-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, user.id)"/>
				
				<div class="friend-details">
					<a class="friend-icon view-icon tooltips left" style="" @click.prevent="viewProfile(user.id)">
						<span>View Profile</span>
						<i class="fa fa-eye"></i>
					</a>
					<a class="friend-icon decline-friend-icon tooltips right" @click.prevent="unfriend(user.id)" 
					@mouseover="addBlackhole()"
    				@mouseleave="removeBlackhole()">
						<span>Unfriend</span>
						<img :src="'/front/icons/blackhole-icon.png'" alt="">
					</a>
					<a class="friend-icon add-friend-icon tooltips top">
						<span>Chat Friend</span>
						<img :src="'/front/icons/chat-icon.png'" alt="">
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
			<p>No Friends.</p>
		</div>

		<div id="search-friends">
            <div id="search-friends-view2">
                <h1 id="search-friends-view2-heading" style="text-align:center">
                    Your Earthlings
                </h1>
                <div class="search-form">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Enter Name to search" v-model="query">
                    <button type="submit" class="btn search-btn" @click.prevent="search">Search</button>
                </div>
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
		return {
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
			const Swal = require('sweetalert2')
			this.declinedRequest = true;
			$('.tooltips span').hide();
			$('button.close-view').hide();

			axios.get('/unfriend/'+user_id)
			.then((response) => {
				// alert(response.data);
				var $this = this;
				setTimeout(function(){
					$('canvas').fadeOut(500, function() {
						$( this ).remove();
						$this.closeAllView();
						$this.users = [];
						$this.fetchfriends();
						$this.refreshHtml();
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
			})
			.catch((error) => {
				console.log(error);
			})
		},
        fetchfriends(){
			axios.get('/fetchfriends?perPage=8')
			.then((response) => {
				console.log(response);
				this.users = response.data.data;
				this.page = response.data.current_page;
				this.last_page = response.data.last_page;
				// alert(response.data);
			})
			.catch((error) => {
				console.log(error);
			})
		},
		search() {
			this.page = 1;
			axios.get(`/fetchfriends?perPage=8&search=${this.query}&page=${this.page}`)
			.then((response) => {
				console.log(response);
				this.users = [];
				this.users = response.data.data;
				this.page = response.data.current_page;
				this.last_page = response.data.last_page;
				this.refreshHtml();
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
		randomBoxShadow() {
			var color = Math.floor(Math.random()*16777215).toString(16);
			// console.log({
			//     'color': '#'+color,
			//     'box-shadow': '0 0 12px 0 #'+color
			// });
			return {
				'color': '#'+color,
				'box-shadow': '0 0 12px 0 #'+color,
				'top': ''
			};
		},
		getMainClass(index) {
			if(index == 0) {
				return 'main-friends with-background';
			} else {
				return 'main-friends';
			}
		},
		handleImgClick(id, user_id) {
			// var target = event.target;
			console.log('view');
			this.declinedRequest = false;
			this.closeAllView();
			$('#'+id).closest('div.main-friends').addClass('with-background');
			var current_friend_id = $('.zoom-in').attr('id');
			console.log(current_friend_id);
			var position_top = $('#'+id).css('top');
			var position_left = $('#'+id).css('left');
			var width = $('#'+id).css('width');
			var height = $('#'+id).css('height');

			$('#'+current_friend_id).removeClass('zoom-in');
			$('#'+current_friend_id).css({
				'transition': '2s',
				'top': position_top,
				'left': position_left,
				'width': width,
				'height': height
			});

			$('#'+current_friend_id+' .friend-details').removeAttr("style");

			$('#'+id).addClass('zoom-in');
			$('#'+id).css('transition', '3s');
		
			$('#'+id+'.zoom-in').on("webkitTransitionEnd transitionend", function(){
				$('#'+id+'.zoom-in .friend-details').css('display', 'flex');
				// $('#'+id).closest('div.main-friends').find('.close-view').css('display', 'flex');
			});
			// blackhole('.with-background');
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
			// $('.friends').removeClass('zoom-in');
			$('.friends').removeClass('rotate');
			// $('.friend-details, button.close-view').hide();
			$('canvas').remove();
		},
		viewProfile(id) {
			window.location.href = '/user_dashboard/'+id;
		},
		refreshHtml() {
			$('.friends').css({
				'transition': '0s',
				'top': '',
				'left': '',
				'width': '',
				'height': ''
			});
			$('.friends').removeClass('zoom-in');
			$('.friend-details').removeAttr("style");
			$('#round-image-large0').addClass('zoom-in');
			$('#round-image-large0 .friend-details').css("display", 'block');
			this.declinedRequest = false;
		},
		nextPage(page) {
			axios.get(`/fetchfriends?perPage=8&search=${this.query}&page=${page + 1}`)
			.then((response) => {
				// console.log(response);
				this.page = page + 1;
				this.users = [];
				this.users = response.data.data;
				this.refreshHtml();
			//  this.getuser(response.data.data)
			})
			.catch((error) => {
				console.log(error);
			})
		},
		previousPage(page) {
			axios.get(`/fetchfriends?perPage=8&search=${this.query}&page=${page - 1}`)
			.then((response) => {
				// console.log(response);
				this.page = page - 1;
				this.users = [];
				this.users = response.data.data;
				this.refreshHtml();
				// $('.friends').css({
				// 	'transition': '0s',
				// 	'top': '',
				// 	'left': '',
				// 	'width': '',
				// 	'height': ''
				// });
				// $('.friends').removeClass('zoom-in');
				// $('.friend-details').removeAttr("style");
				// $('#round-image-large0').addClass('zoom-in');
				// $('#round-image-large0 .friend-details').css("display", 'block');
			//  this.getuser(response.data.data)
			})
			.catch((error) => {
				console.log(error);
			})
		},
		addBlackhole() {
			if(!this.declinedRequest) {
				blackhole('.with-background', 255, 2.2);
				$('canvas').fadeIn(500);
			}
		},
		removeBlackhole() {
			if(!this.declinedRequest) {
				$('canvas').fadeOut(500, function() {
					$(this).remove();
				});
			}
		}
  	}
}
</script>
