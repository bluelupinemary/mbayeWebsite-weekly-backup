<template>
    <div class="your-profile-div">
        <span v-if="notificationCount" class="notification-count">{{notificationCount}}</span>
	    <img :src="'/front/images/communicator-buttons/buttons/yourProfileBtn.png'" :class="'communicator-button your-profile-button '+hasNotification(notificationCount)" @click="viewDashboard()" alt="">
    </div>
</template>

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
                this.notifications = response.data;
                console.log(this.notifications);
                })
            .catch(function (error) {
                console.log(error);
            });
        },
        hasNotification(notificationCount)
        {
            console.log(notificationCount);
            if(notificationCount) {
                return 'has-notification';
            }
        },
        viewDashboard()
        {
            window.location.href = '/dashboard';
        }
    }
}
</script>