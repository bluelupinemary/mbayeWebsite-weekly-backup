<template>
    <div class="notifications-div">
        <button class="earth-holo tooltips top" :disabled="notificationCount < 1">
            <span>View Notifications</span>
            <p v-if="notificationCount > 0" class="notifications-count">{{notificationCount}}</p>
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
        return {
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

        EventBus.$on('Read_notification', () => {
            this.getnotifications();
        })
    },
    computed: {
        notificationCount () {
            return this.notifications && Object.keys(this.notifications).length;
        }
    },
    methods: {
        getnotifications() {
            axios.post('/api/notify/', {
                user_id: this.user.id,
            })
            .then((response) => {
                // console.log(response);
                this.notifications = response.data;
                console.log(this.notifications);
                console.log(Object.entries(this.notifications));
                // console.log('length: '+Object.keys(this.notifications).length);
                })
            .catch(function (error) {
                console.log(error);
            });
        },
        movetoread(notification) {
            axios.post('/api/readnotification', {
                notification_id: notification.id,
            })
            .then((response) => {
                if(notification.type.includes('GeneralReactionNotification')) {
                    window.open('/single_general_blog/'+notification.data.blog_id, '_blank');
                } else if(notification.type.includes('ReactionNotification')) {
                    window.open('/single_blog/'+notification.data.blog_id, '_blank');
                } else if(notification.type.includes('FriendRequestNotification')) {
                    window.open('/requests', '_blank');
                } else if(notification.type.includes('AcceptRequestNotification')) {
                    window.open('/friends?friend_id='+notification.data.user.id, '_blank');
                } else if(notification.type.includes('GeneralCommentNotification')) {
                    window.open('/single_general_blog/'+notification.data.blog_id, '_blank');
                } else if(notification.type.includes('CommentNotification')) {
                    window.open('/single_blog/'+notification.data.blog_id, '_blank');
                } else if(notification.type.includes('GeneralBlogShareNotification')) {
                    window.open('/single_general_blog/'+notification.data.blog.blog_id, '_blank');
                } else if(notification.type.includes('BlogShareNotification')) {
                    if(notification.data.blog.blog_type.includes('GeneralBlog')) {
                        window.open('/single_general_blog/'+notification.data.blog.blog_id, '_blank');
                    } else if(notification.data.blog.blog_type.includes('Blog')) {
                        window.open('/single_blog/'+notification.data.blog.blog_id, '_blank');
                    }
                }

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




