
require('./bootstrap');

window.Vue = require('vue');

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)

import Multiselect from 'vue-multiselect'
// register globally
Vue.component('multiselect', Multiselect)

// Vue.component('chats', require('./components/ChatsComponent.vue').default);
Vue.component('groupchats-component', require('./components/GroupChatsComponent.vue').default);
Vue.component('privatechat-component', require('./components/PrivateChatComponent.vue').default);



const app = new Vue({
    el: '#app'
});
