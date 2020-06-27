
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { dom } from '@fortawesome/fontawesome-svg-core'
// import VueMaterial from 'vue-material'
// import 'vue-material/dist/vue-material.min.css'

dom.watch();

library.add(fas);
require('../bootstrap');
window.Vue = require('vue');
// Vue.use(VueMaterial);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('font-awesome-icon', FontAwesomeIcon);
// Vue.component('flash', require('../components/Flash.vue').default);
Vue.component('comment-component', require('../components/frontend/Comment.vue').default);
Vue.component('like-component', require('../components/frontend/Like.vue').default);
Vue.component('hotcount-component', require('../components/frontend/HotCount.vue').default);
Vue.component('coolcount-component', require('../components/frontend/CoolCount.vue').default);
Vue.component('naffcount-component', require('../components/frontend/NaffCount.vue').default);
Vue.component('commentcount-component', require('../components/frontend/CommentCount.vue').default);
Vue.component('multicount-component', require('../components/frontend/MultiCount.vue').default);
Vue.component('commentnotification-component', require('../components/frontend/CommentNotifications.vue').default);
Vue.component('searchfriends-component', require('../components/frontend/SearchFriends.vue').default);
Vue.component('accept-component', require('../components/frontend/AcceptRequestComponent.vue').default);
Vue.component('friends-component', require('../components/frontend/FriendComponent.vue').default);
Vue.component('photoeditor-component', require('../components/frontend/PhotoEditor.vue').default);
Vue.component('general-photoeditor-component', require('../components/frontend/GeneralBlogPhotoEditor.vue').default);

const app = new Vue({
    el: '.app',
});