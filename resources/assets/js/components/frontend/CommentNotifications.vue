<template>
<div class="bell-icon-div ui-widget-content slide_10">
<span class="badge badge-dark badge-pill">{{notificationCount}}</span>
<a type="button" data-toggle="modal" data-target="#exampleModalScrollable" v-on:click="show_modal()"><img class="bell-img" src="/front/images/bell.png"></a>
<!-- Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <ul id="example-1">
                  <li v-for="(notification,index) in this.notifications" :key="index">
                    <a href="#" v-on:click.prevent="movetoread(notification.id)">{{notification.data.message}}</a>
                  </li>
                </ul>
                </div>
            </div>
            </div>
        </div>
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
                alert(response.data);
                this.getnotifications();
                })
            .catch(function (error) {
              console.log(error);
            });
        },
        show_modal() {
          $('#exampleModalScrollable').modal('show');
        }
      }
    }
</script>




