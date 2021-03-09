<template>
    <div class="notifications-list-div">
        <div class="notification-table-div">
            <table class="table table-striped table-hover notification-table">
                <tbody>
                    <tr v-for="(notification,index) in this.notifications" :key="index">
                        <td href="#" v-if="(notification.type.includes('ReactionNotification') || notification.type.includes('GeneralReactionNotification')) && notification.data.emotion == 0" v-on:click.prevent="movetoread(notification)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/hotNew.png" alt=""> your "{{notification.data.blog_name}}" blog</td>
                        <td href="#" v-else-if="(notification.type.includes('ReactionNotification') || notification.type.includes('GeneralReactionNotification')) && notification.data.emotion == 1" v-on:click.prevent="movetoread(notification)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/cool300.png" alt=""> your "{{notification.data.blog_name}}" blog</td>
                        <td href="#" v-else-if="(notification.type.includes('ReactionNotification') || notification.type.includes('GeneralReactionNotification')) && notification.data.emotion == 2" v-on:click.prevent="movetoread(notification)">{{notification.data.author_first_name+' '+notification.data.author_last_name}} <img src="/front/icons/naffPicked.png" alt="" class="naff-icon"> your "{{notification.data.blog_name}}" blog</td>
                        <td href="#" v-else-if="notification.type.includes('FriendRequestNotification') || notification.type.includes('AcceptRequestNotification')" v-on:click.prevent="movetoread(notification)">{{notification.data.user.first_name+' '+notification.data.user.last_name}} {{notification.data.message}}</td>
                        <td href="#" v-else-if="notification.type.includes('CommentNotification') || notification.type.includes('GeneralCommentNotification') || notification.type.includes('BlogShareNotification') || notification.type.includes('GeneralBlogShareNotification')" v-on:click.prevent="movetoread(notification)">{{notification.data.message}}</td>
                        <td class="datetime"><time-ago :refresh="60" :datetime="notification.created_at" :long="true"></time-ago></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <nav class="pagination-div">
            <paginate 
            v-model="currentPage"
            :pageCount="pageCount"
            :page-range="3"
            :containerClass="'pagination'"
            :page-class="'page-item'"
            :page-link-class="'page-link'"
            :prev-link-class="'page-link'"
            :next-link-class="'page-link'"
            :clickHandler="clickCallback">
            </paginate>
        </nav>
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
import TimeAgo from 'vue2-timeago'

export default {
    props:{
        user:Object 
    },
    components: {
        TimeAgo,
    },
    data:function() {
        return {
            notifications: [],
            author:'',
            notif_type: '',
            pageCount: 1,
            currentPage: 1,
        }
    },
    mounted() {
        this.getnotifications();
        Echo.private('App.User.'+this.user.id)
            .notification((notification) => {
            // console.log(notification);
            this.getnotifications();
        });
    },
    computed: {
        // notificationCount () {
        //     return this.notifications && Object.keys(this.notifications).length;
        // }
    },
    methods: {
        getnotifications() {
            axios.post('/api/notification_list/', {
                user_id: this.user.id,
            })
            .then((response) => {
                // console.log(response);
                this.notifications = response.data.data;
                this.pageCount = response.data.last_page;
                this.currentPage = response.data.current_page;
                console.log(this.notifications);
                // console.log(Object.entries(this.notifications));
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
                console.log(notification);
                if(notification.type.includes('GeneralReactionNotification')) {
                    window.open('/single_general_blog/'+notification.data.blog_id, "_blank") || window.location.replace('/single_general_blog/'+notification.data.blog_id);
                } else if(notification.type.includes('ReactionNotification')) {
                    window.open('/single_blog/'+notification.data.blog_id, "_blank") || window.location.replace('/single_blog/'+notification.data.blog_id);
                } else if(notification.type.includes('FriendRequestNotification')) {
                    window.open('/requests', "_blank") || window.location.replace('/requests');
                } else if(notification.type.includes('AcceptRequestNotification')) {
                    window.open('/friends?friend_id='+notification.data.user.id, "_blank") || window.location.replace('/friends?friend_id='+notification.data.user.id);
                } else if(notification.type.includes('GeneralCommentNotification')) {
                    window.open('/single_general_blog/'+notification.data.blog_id, "_blank") || window.location.replace('/single_general_blog/'+notification.data.blog_id);
                } else if(notification.type.includes('CommentNotification')) {
                    window.open('/single_blog/'+notification.data.blog_id, "_blank") || window.location.replace('/single_blog/'+notification.data.blog_id);
                } else if(notification.type.includes('GeneralBlogShareNotification')) {
                    window.open('/shared_story/'+notification.data.blog.id, "_blank") || window.location.replace('/shared_story/'+notification.data.blog.id);
                } else if(notification.type.includes('BlogShareNotification')) {
                    window.open('/shared_blog/'+notification.data.blog_id, "_blank") || window.location.replace('/shared_blog/'+notification.data.blog_id);
                    // if(notification.data.blog.blog_type.includes('GeneralBlog')) {
                    //     window.open('/shared_blog/'+notification.data.blog.id, "_blank") || window.location.replace('/shared_blog/'+notification.data.blog.id);
                    // } else if(notification.data.blog.blog_type.includes('Blog')) {
                    //     window.open('/shared_blog/'+notification.data.blog.blog_id, '_blank');
                    // }
                }

                EventBus.$emit('Read_notification');
                this.clickCallback(this.currentPage);
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
            // console.log(type);
            if(type == 'App\Notifications\Frontend\ReactionNotification') {
                return 'reaction';
            } else if (type == 'App\Notifications\Frontend\CommentNotification') {
                return 'comment';
            } else if(type == 'App\Notifications\Frontend\FriendRequestNotification') {
                return 'friend_request';
            }
            // console.log(type,this.notif_type);
            // return notif_type;
        },
        clickCallback: function(page) {
            axios.post('/api/notification_list?page='+page, {
                user_id: this.user.id,
            })
            .then((response) => {
                // console.log(response);
                this.notifications = response.data.data;
                this.pageCount = response.data.last_page;
                this.currentPage = response.data.current_page;
                // console.log(this.notifications);
                // console.log(Object.entries(this.notifications));
                // console.log('length: '+Object.keys(this.notifications).length);
                })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>




