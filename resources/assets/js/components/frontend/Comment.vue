<style>
#submit {
    font-family: Nasalization;
    margin-top: 1%;
    background: #17a2b8;
    border: 0;
}

#submit:hover {
    background: #17a2b8;
    border-color: #17a2b8;
}

#submit:focus {
    outline: 0;
    box-shadow: none;
}
</style>
<template>
    <div class="blog-comments">
        <h2>Declarations</h2>
        <div class="blog-comments-count">
            <img src="/front/icons/commentsNew.png" alt="">
            <span class="comments-count">: {{commentCount}}</span>
        </div>
        <!-- <textarea id="body" name="body" cols="30" rows="10" placeholder="Write comments here" v-model="commentBox" @keyup.enter.prevent="postComment"></textarea> -->
        <textarea id="body" name="body" cols="30" rows="10" placeholder="Write comments here" v-model="commentBox"></textarea>
        <button v-if="this.blog_type=='regular'" class="btn btn-xs btn-primary ld-ext-left" id="submit" @click.prevent="postComment" :disabled="commentBox == ''"><div class="ld ld-ring ld-spin"></div> <span class="text">Declare</span></button>
        <button v-else class="btn btn-xs btn-primary ld-ext-left" id="submit" @click.prevent="postgeneralComment" :disabled="commentBox == ''"><div class="ld ld-ring ld-spin"></div> <span class="text">Declare</span></button>

        <div class="blog-comments-thread">
            <!-- <div id="new_c"></div> -->
                <div class="blog-comment" v-for="(comment,index) in comments" :key="index">
                    <div class="user-picture" @mouseover="showName()" @mouseleave="hideName()">
                        <div class="user-image">
                            <img v-if="comment.user.gender == 'female'" src="/front/icons/comment-female.png" alt="" class="astro">
                            <img v-else src="/front/icons/comment-male.png" alt="" class="astro">

                            <img v-if="comment.user.photo" :src="'/storage/profilepicture/'+comment.user.photo" alt="" class="user-photo">
                            <img v-else :src="'/storage/profilepicture/default.png'" alt="" class="user-photo">
                        </div>
                        <div class="user-title" @dblclick="viewCommentOwner(comment.user.id)">
                            <div class="username">
                                <div v-if="comment.user.gender == 'female'" class="title">Mjr Thomasina</div> 
                                <div v-else class="title">Mjr Tom</div> 
                                <div class="user-name" >{{comment.user.first_name+' '+comment.user.last_name}}</div>
                            </div>
                            <p class="comment-date"><time-ago :refresh="60" :datetime="comment.created_at" :long="true"></time-ago></p>
                        </div>
                    </div>
                    <div class="message">
                        <p>{{ comment.body }}</p>
                        <img src="/front/icons/replyIcon.png" alt="">
                    </div>
                </div> 
        </div>
    </div>
</template>

<script>
import EventBus from '../../frontend/event-bus';
import TimeAgo from 'vue2-timeago'

export default {
    props:{
        blog_id:Number,
        user:Object,
        blog_type:String,
    },
    components: {
        TimeAgo,
    },
    data:function() {
        return {
            comments: {},
            commentBox: '',
            commentcount:'',
        }
    },
    mounted() {
        if(this.blog_type=="regular"){
            this.getComments();
            Echo.channel('blog'+this.blog_id)
                .listen('NewComment',(comment) => {
                    //this.comments.push(event.comment);
                    console.log("listned");
                    this.comments.unshift(comment);
                });
        } else {
            this.getgeneralComments();
            Echo.channel('generalblog'+this.blog_id)
                .listen('NewGeneralComment',(comment) => {
                    //this.comments.push(event.comment);
                    console.log("listned");
                    this.comments.unshift(comment);
                });
        }
    },
    computed: {
        commentCount () {
            this.commentcount = this.comments && this.comments.length;
            if(this.blog_type=="regular"){
            EventBus.$emit('commentcount', this.commentcount);
            }else{
            EventBus.$emit('generalcommentcount', this.commentcount);
            }
            return this.commentcount;
        }
    },
    methods: {
        getComments() {
            axios.get('/api/blogs/'+this.blog_id+'/comments')
                .then((response) => {
                this.comments = response.data;

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        postComment() {
            $('button#submit').prop('disabled', true);
            $('button#submit').addClass('running');
            $('button#submit .text').html('Sending');

            axios.post('/api/blogs/'+this.blog_id+'/comment', {
                user_id: this.user.id,
                body: this.commentBox
            })
            .then((response) => {
                $('button#submit').prop('disabled', false);
                $('button#submit').removeClass('running');
                $('button#submit .text').html('Declare');

                this.getComments();
                this.commentBox = '';
                Echo.channel('blog'+this.blog_id)
                .listen('NewComment',(event) => {
                    console.log("listned"); 
                });
            
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getgeneralComments() {
            axios.get('/api/blogs/'+this.blog_id+'/generalcomments')
            .then((response) => {
            // alert(response.data);
                this.comments = response.data;
                })
            .catch(function (error) {
            console.log(error);
            });
        },
        postgeneralComment() {
            $('button#submit').prop('disabled', true);
            $('button#submit').addClass('running');
            $('button#submit .text').html('Sending');

            axios.post('/api/blogs/'+this.blog_id+'/generalcomment', {
                user_id: this.user.id,
                body: this.commentBox
            })
            .then((response) => {
                $('button#submit').prop('disabled', false);
                $('button#submit').removeClass('running');
                $('button#submit .text').html('Declare');

                this.getgeneralComments();
                this.commentBox = '';
                Echo.channel('generalblog'+this.blog_id)
                .listen('NewGeneralComment',(event) => {
                    console.log("listned"); 
                });
            
            })
            .catch((error) => {
                console.log(error);
            });
        },
        showName() {
            var target = $(event.target);
            // var element = target.find('.title').;

            target.find('.title').css({
                    'opacity': '1',
                    'width': '100%',
                    'flex' : 'auto'
                });
            // console.log(target.querySelector('.title'));
            // target.find('.title').toggle({ direction: "right" }, 1000)
            // $(this).find('.title').toggle({ direction: "right" }, 1000);
            // target.querySelector('.title').toggle({ direction: "right" }, 1000);
        },
        hideName() {
            var target = $(event.target);
            target.find('.title').css({
                'opacity': '0',
                'width': '0%',
                'flex' : 'unset'
            });
        },
        viewCommentOwner(user_id) {
            if(user_id == this.user.id) {
                window.location.href = '/dashboard';
            } else {
                window.location.href = '/user_dashboard/'+user_id;
            }
        }
    }
}
</script>
