<template>
	<div class="notifications-div">
		<div class="notifications-list">
			<ul id="example-1">
				<li v-for="(notification,index) in this.notifications" :key="index">
					<a href="#" v-if="notification.type.includes('ReactionNotification') && notification.data.emotion == 0" v-on:click.prevent="movetoread(notification.id)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/hotNew.png" alt=""> your {{notification.data.blog_name}}</a>
					<a href="#" v-if="notification.type.includes('ReactionNotification') && notification.data.emotion == 1" v-on:click.prevent="movetoread(notification.id)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/cool300.png" alt=""> your {{notification.data.blog_name}}</a>
					<a href="#" v-if="notification.type.includes('ReactionNotification') && notification.data.emotion == 2" v-on:click.prevent="movetoread(notification.id)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/naffPicked.png" alt=""> your {{notification.data.blog_name}}</a>
					<a href="#" v-if="notification.type.includes('FriendRequestNotification') || notification.type.includes('AcceptRequestNotification')" v-on:click.prevent="movetoread(notification.id)">{{notification.data.user.first_name+' '+notification.data.user.last_name}} {{notification.data.message}}</a>
					<a href="#" v-if="notification.type.includes('CommentNotification')" v-on:click.prevent="movetoread(notification.id)">{{notification.data.message}}</a>
					
					<!-- <a href="#" v-else v-on:click.prevent="movetoread(notification.id)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/naffPicked.png" alt=""> your {{notification.data.blog_name}}</a> -->
				</li>
			</ul>
		</div>
		<button class="earth-holo tooltips top">
			<span>View Notifications</span>
			<p class="notifications-count">{{notificationCount}}</p>
			<img src="/front/images/notification-hologram/earthHolo.png" alt="">
		</button>
		<img src="/front/images/notification-hologram/hologram.png" alt="" class="hologram">
	</div>
</template>

<style scoped>
#exampleModalScrollable{
  	padding: 0;
    display: block;
    position: absolute;
    background: white;
    width: 40vw;
    height: 40vh;
    margin: inherit;
    left: 50%;
    top: 50%;
    transform: translate(0%, -105%);
}

.modal{
  padding: 0 !important;
}
.modal-content{
  border-radius: 0 !important;
}
.modal-content{
  width: 100% !important;
  max-width: 100% !important;
}
.modal-dialog{
  margin: 0 !important;
}
</style>

<script>
import EventBus from '../../frontend/event-bus';
      export default {
        props:{
            user:Object 
            },
        data:function() {
            return{
                notifications: [],
				author:'',
				notif_type: ''
        }
      },
      mounted() {
        this.getnotifications();
        Echo.private('App.User.'+this.user.id)
            .notification((notification) => {
            console.log(notification);
            this.getnotifications();
        });
      },
      computed: {
      notificationCount () {
        return this.notifications && this.notifications.length
      }
    },
      methods: {
        getnotifications() {
        
          axios.post('/api/notify/', {
            user_id: this.user.id,
          })
            .then((response) => {
                this.notifications = response.data;
                console.log(this.notifications);
                })
            .catch(function (error) {
              console.log(error);
            });
        },
        movetoread(id){
          axios.post('/api/readnotification', {
            notification_id: id,
          })
            .then((response) => {
                // alert(response.data);
                this.getnotifications();
                })
            .catch(function (error) {
              console.log(error);
            });
        },
        show_modal() {
          $('#exampleModalScrollable').modal('show');
		},
		checkNotificationType(type) {
			// var notif_type;
			console.log(type);
			if(type == 'App\Notifications\Frontend\ReactionNotification') {
				return 'reaction';
			} else if (type == 'App\Notifications\Frontend\CommentNotification') {
				return 'comment';
			} else if(type == 'App\Notifications\Frontend\FriendRequestNotification') {
				return 'friend_request';
			}
			// console.log(type,this.notif_type);
			// return notif_type;
		}
      }
    }
</script>




