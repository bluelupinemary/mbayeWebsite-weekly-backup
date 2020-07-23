
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { dom } from '@fortawesome/fontawesome-svg-core'
import Vue2TouchEvents from 'vue2-touch-events'
 

// import VueMaterial from 'vue-material'
// import 'vue-material/dist/vue-material.min.css'

dom.watch();

library.add(fas);
require('../bootstrap');
window.Vue = require('vue');
window.axios.defaults.baseURL = document.head.querySelector('meta[name="url"]').content;
// Vue.use(VueMaterial);
Vue.use(Vue2TouchEvents)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('font-awesome-icon', FontAwesomeIcon);
// Vue.component('flash', require('../components/Flash.vue').default);
Vue.component('comment-component', require('../components/frontend/Comment.vue').default);
Vue.component('generalcomment-component', require('../components/frontend/GeneralComment.vue').default);
Vue.component('like-component', require('../components/frontend/Like.vue').default);
Vue.component('generallike-component', require('../components/frontend/GeneralLike.vue').default);
Vue.component('hotcount-component', require('../components/frontend/HotCount.vue').default);
Vue.component('coolcount-component', require('../components/frontend/CoolCount.vue').default);
Vue.component('naffcount-component', require('../components/frontend/NaffCount.vue').default);

Vue.component('generalhotcount-component', require('../components/frontend/GeneralHotCount.vue').default);
Vue.component('generalcoolcount-component', require('../components/frontend/GeneralCoolCount.vue').default);
Vue.component('generalnaffcount-component', require('../components/frontend/GeneralNaffCount.vue').default);
Vue.component('commentcount-component', require('../components/frontend/CommentCount.vue').default);
Vue.component('generalcommentcount-component', require('../components/frontend/GeneralCommentCount.vue').default);
Vue.component('multicount-component', require('../components/frontend/MultiCount.vue').default);
Vue.component('commentnotification-component', require('../components/frontend/CommentNotifications.vue').default);
Vue.component('searchfriends-component', require('../components/frontend/SearchFriends.vue').default);
Vue.component('accept-component', require('../components/frontend/AcceptRequestComponent.vue').default);
Vue.component('friends-component', require('../components/frontend/FriendComponent.vue').default);
Vue.component('generalblog-component', require('../components/frontend/GeneralBlog.vue').default);
Vue.component('newblog-component', require('../components/frontend/blog.vue').default);
Vue.component('photoeditor-component', require('../components/frontend/PhotoEditor.vue').default);
Vue.component('general-photoeditor-component', require('../components/frontend/GeneralBlogPhotoEditor.vue').default);
Vue.component('designsphotoeditor-component', require('../components/frontend/DesignsBlogPhotoEditor.vue').default);
Vue.component('blogview-component', require('../components/frontend/BlogViewComponent.vue').default);
Vue.component('designpanelblog-component', require('../components/frontend/DesignPanelBlogComponent.vue').default);
Vue.component('designpanelhome-component', require('../components/frontend/DesignPanelHomeComponent.vue').default);
const app = new Vue({
    el: '.app',
});