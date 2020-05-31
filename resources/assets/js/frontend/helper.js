import Vue from 'vue';
import EventBus from './event-bus';
export default new Vue({
methods:{
   countemotions(blogid) {
   axios.post('/api/countemotions', {
       blog_id: blogid,
   })
         .then((response) => {
             const emo = {
               hotcount: response.data.hot,
               coolcount: response.data.cool,
               naffcount: response.data.naff,
               }
               
               EventBus.$emit('Emotion_sent', emo);
              
             })
         .catch(function (error) {
           console.log(error);
         });  
 },
 getnotifications(userid) {
  axios.post('/api/notify/', {
    user_id: userid,
  })
    .then((response) => {
        this.notifications = response.data;
        })
    .catch(function (error) {
      console.log(error);
    });
},
}
})