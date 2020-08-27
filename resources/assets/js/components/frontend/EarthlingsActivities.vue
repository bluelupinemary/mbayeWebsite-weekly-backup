
<template>
 <section class="container-fluid">
    <!-- Next and Previous buttons -->
        <div class="arrow-left" @click="previousPage(page)" v-if="page > 1 && page <= last_page">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
        <div class="arrow-right" @click="nextPage(page)" v-if="page < last_page">
            <i class="fas fa-chevron-circle-right"></i>
        </div>
        <!-- Next and Previous buttons -->

        <!-- 5 main images -->
		<div v-if="blogs.length" >
      	<div v-for="(blog,index) in blogs" class="main-friends" :key="index">
			<div v-if="index == 0" :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse zoom-in" 
                @mouseover="showBlogDetails('round-image-large' + index, blog.id)"
    			@mouseout="hideBlogDetails('round-image-large' + index, blog.id)">
				<img :src="blog.featured_image" :key="blog.id" id="blog-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, blog.id)"/>
				
				<div class="friend-details" style="display: block;" >
                    <p class="blog-title">{{blog.name}}</p>
					<p class="friend-name">{{blog.owner.first_name}} {{blog.owner.last_name}}</p>
					<p class="friend-address">{{blog.owner.address}}</p>
				</div>

                <div class="friend-details-2">
                    <p class="blog-summary">{{blog.summary}}</p>
					<p class="blog-date">{{blog.formatted_date}}</p>
					<div class="blog-tags">
                        <ul class="tags">
                            <li v-for="(tag,i) in blog.tags" :key="i" class="tag"><i class="fas fa-tag"></i> {{ tag.name }}</li>
                        </ul>
                    </div>
                    <a href="" @click.prevent="viewBlog(blog)">(Click this to view the post)</a>
				</div>
			</div>
            <div v-else :id="'round-image-large' + index" :style="randomBoxShadow()" class="friends ani-rolloutUse"
                @mouseover="showBlogDetails('round-image-large' + index, blog.id)"
    			@mouseout="hideBlogDetails('round-image-large' + index, blog.id)">
				<img :src="blog.featured_image" :key="blog.id" id="blog-img" data-toggle="modal" data-target="#exampleModalCenter" @click="handleImgClick('round-image-large' + index, blog.id)"/>
				
				<div class="friend-details">
                    <p class="blog-title">{{blog.name}}</p>
					<p class="friend-name">{{blog.owner.first_name}} {{blog.owner.last_name}}</p>
					<p class="friend-address">{{blog.owner.address}}</p>
				</div>

                <div class="friend-details-2">
                    <p class="blog-summary">{{blog.summary}}</p>
					<p class="blog-date">{{blog.formatted_date}}</p>
					<div class="blog-tags">
                        <ul class="tags">
                            <li v-for="(tag,i) in blog.tags" :key="i" class="tag"><i class="fas fa-tag"></i> {{ tag.name }}</li>
                        </ul>
                    </div>
					<!-- <p class="blog-tags">{{blog.all_tags}}</p> -->
                    <a href="" @click.prevent="viewBlog(blog)">(Click this to view the post)</a>
				</div>
			</div>
      	</div>
		</div>
		<div v-else class="no-friend-request">
			<p>No Blogs.</p>
		</div>

		<div id="search-friends">
            <div id="search-friends-view2">
                <h1 id="search-friends-view2-heading" style="text-align:center">
                    Earthlings' Activities
                </h1>
                <!-- <div class="search-form">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Enter Name to search" v-model="query">
                    <button type="submit" class="btn search-btn" @click.prevent="search">Search</button>
                </div> -->
            </div>
        </div>
  </section>
</template>

<script>
export default {
    props:{
        user: Object
    },
    data:function() {
		return {
			blogs: [],
			blogList: [],
			page: 1,
			query: "",
			searched: false,
			cursor: "pointer",
			next: false,
			last_page: '',
			showDialog: false,
			selectedblog: {},
			activeClass:"hide",
            declinedRequest: false,
            currentID: 0
        }
    },
	mounted () {
		// console.log(this.auth.id);
		this.fetchblogs();
		
		// Echo.channel('App.blog.'+this.auth.id)
		// 	.listen('RequestAccepted',(friendship) => {
		// 		//this.comments.push(event.comment);
		// 		console.log(friendship);
		// 		this.fetchfriends();
		// 		// this.comments.unshift(comment);
				
        // 	});
	},
  	methods:{
        fetchblogs(){
			let that = this;

			axios.post('/api/blog_activities/', {
                user_id: this.user.id,
            })
			.then((response) => {
                // console.log(response.data.data);
				// that.blogs = response.data;
				that.page = response.data.current_page;
				that.last_page = response.data.last_page;

				var i = 0;
				that.blogs = [];
				$.each(response.data.data, function(index, value) {
					that.$set(that.blogs, index, value.data.blog);

					if(value.type.includes('GeneralBlogActivityNotification')) {
						if(that.blogs[index].featured_image != null) {
							that.blogs[index].featured_image = '/storage/img/general_blogs/'+that.blogs[index].featured_image;
						} else {
							that.blogs[index].featured_image = '/storage/img/general_blogs/blog-default-featured-image.png';
						}
					} else if(value.type.includes('BlogActivityNotification')) {
						if(that.blogs[index].featured_image != null) {
							that.blogs[index].featured_image = '/storage/img/blog/'+that.blogs[index].featured_image;
						} else {
							that.blogs[index].featured_image = '/storage/img/blog/blog-default-featured-image.png';
						}
					}

					that.blogs[index].notification_id = value.id;
					that.blogs[index].notification_type = value.type;
				});
				// console.log(that.currentID);
				that.currentID = that.blogs[0].id;
			})
			.catch((error) => {
				console.log(error);
			})
		},
		// search() {
		// 	this.page = 1;
		// 	axios.get(`/fetchfriends?perPage=3&search=${this.query}&page=${this.page}`)
		// 	.then((response) => {
		// 		console.log(response);
		// 		this.blogs = [];
		// 		this.blogs = response.data.data;
		// 		this.page = response.data.current_page;
		// 		this.last_page = response.data.last_page;
		// 		this.refreshHtml();
		// 		// alert(response.data);
		// 	})
		// 	.catch((error) => {
		// 		console.log(error);
		// 	})
		// },
		// block(blog_id){
		// 	axios.get('/block/'+blog_id)
		// 	.then((response) => {
		// 		alert(response.data);
		// 	})
		// 	.catch((error) => {
		// 		console.log(error);
		// 	})
		// },
		// groupfriend(blog_id) {
		// 	axios.post('/groupfriend/', {
		// 		id: blog_id,
		// 		name: "friends",
		// 	})
		// 	.then((response) => {
		// 		alert(response.data);
		// 	})
		// 	.catch((error) => {
		// 		console.log(error);
		// 	});
		// },
        // ungroupfriend(blog_id) {
		// 	alert('helloo');
		// 	axios.post('/ungroupfriend/', {
		// 		id: blog_id,
		// 		name: "friends",
		// 	})
		// 	.then((response) => {
		// 		alert(response.data);
		// 	})
		// 	.catch((error) => {
		// 		console.log(error);
		// 	});
		// },
		viewBlog(blog) {
			axios.post('/api/readnotification', {
                notification_id: blog.notification_id,
            })
            .then((response) => {
                if(blog.notification_type.includes('GeneralBlogActivityNotification')) {
                    window.open('/single_general_blog/'+blog.id, '_blank');
                } else if(blog.notification_type.includes('BlogActivityNotification')) {
                    window.open('/single_blog/'+blog.id, '_blank');
                }

				this.fetchblogs();
				this.refreshHtml();
            })
            .catch(function (error) {
                console.log(error);
            });
		},
		randomBoxShadow() {
			var color = Math.floor(Math.random()*16777215).toString(16);
			// console.log({
			//     'color': '#'+color,
			//     'box-shadow': '0 0 12px 0 #'+color
			// });
			return {
				'color': '#'+color,
				'box-shadow': '0 0 12px 0 #'+color,
				'top': ''
			};
		},
		getMainClass(index) {
			if(index == 0) {
				return 'main-friends with-background';
			} else {
				return 'main-friends';
			}
		},
		handleImgClick(id, blog_id) {
            // var target = event.target;
            var $this = this;
			console.log('view');
            this.declinedRequest = false;
			this.closeAllView();
			// $('#'+id).closest('div.main-friends').addClass('with-background');
			var current_friend_id = $('.zoom-in').attr('id');
			console.log(current_friend_id);
			var position_top = $('#'+id).css('top');
			var position_left = $('#'+id).css('left');
			var width = $('#'+id).css('width');
			var height = $('#'+id).css('height');

			$('#'+current_friend_id).removeClass('zoom-in');
			$('#'+current_friend_id).css({
				'transition': '2s',
				'top': position_top,
				'left': position_left,
				'width': width,
                'height': height,
                'pointer-events': 'none'
			});

            $('#'+current_friend_id+' .friend-details').removeAttr("style");

			$('#'+id).addClass('zoom-in');
			$('#'+id).css('transition', '3s');
		
			$('#'+id+'.zoom-in').on("webkitTransitionEnd transitionend", function(){
                $('#'+id+'.zoom-in .friend-details').css('display', 'flex');
                $this.currentID = blog_id;
                $('#'+current_friend_id).css('pointer-events', 'auto');
				// $('#'+id).closest('div.main-friends').find('.close-view').css('display', 'flex');
			});
			// blackhole('.with-background');
		},
		closeView(id) {
			console.log('close');
			$('#'+id).closest('div.main-friends').removeClass('with-background');
			$('#'+id).removeClass('zoom-in');
			$('#'+id+' .friend-details').css('display', 'none');
			$('#'+id).closest('div.main-friends').find('button.close-view').css('display', 'none');
		},
		closeAllView() {
			$('.main-friends').removeClass('with-background');
			// $('.friends').removeClass('zoom-in');
			$('.friends').removeClass('rotate');
			// $('.friend-details, button.close-view').hide();
			$('canvas').remove();
		},
		refreshHtml() {
			$('.friends').css({
				'transition': '0s',
				'top': '',
				'left': '',
				'width': '',
				'height': ''
			});
			$('.friends').removeClass('zoom-in');
			$('.friend-details').removeAttr("style");
			$('#round-image-large0').addClass('zoom-in');
			$('#round-image-large0 .friend-details').css("display", 'block');
			this.declinedRequest = false;
		},
		nextPage(page) {
			let that = this;

			axios.post(`/api/blog_activities?page=${page + 1}`, {
                user_id: this.user.id,
            })
			.then((response) => {
                // console.log(response.data);
				
				// that.blogs = response.data;
				that.page = page + 1;
				that.blogs = [];
				var i = 0;
				$.each(response.data.data, function(index, value) {
					that.$set(that.blogs, i, value.data.blog);

					if(value.type.includes('GeneralBlogActivityNotification')) {
						if(that.blogs[i].featured_image != null) {
							that.blogs[i].featured_image = '/storage/img/general_blogs/'+that.blogs[i].featured_image;
						} else {
							that.blogs[i].featured_image = '/storage/img/general_blogs/blog-default-featured-image.png';
						}
					} else if(value.type.includes('BlogActivityNotification')) {
						if(that.blogs[i].featured_image != null) {
							that.blogs[i].featured_image = '/storage/img/blog/'+that.blogs[i].featured_image;
						} else {
							that.blogs[i].featured_image = '/storage/img/blog/blog-default-featured-image.png';
						}
					}

					that.blogs[i].notification_id = value.id;
					that.blogs[i].notification_type = value.type;
					i++;
				});
				// console.log(that.blogs);
				that.currentID = that.blogs[0].id;
				that.refreshHtml();
			})
			.catch((error) => {
				console.log(error);
			})
		},
		previousPage(page) {
			let that = this;

			axios.post(`/api/blog_activities?page=${page - 1}`, {
                user_id: this.user.id,
            })
			.then((response) => {
                // console.log(response.data);
				
				// that.blogs = response.data;
				that.page = page - 1;
				that.blogs = [];
				var i = 0;
				$.each(response.data.data, function(index, value) {
					that.$set(that.blogs, i, value.data.blog);

					if(value.type.includes('GeneralBlogActivityNotification')) {
						if(that.blogs[i].featured_image != null) {
							that.blogs[i].featured_image = '/storage/img/general_blogs/'+that.blogs[i].featured_image;
						} else {
							that.blogs[i].featured_image = '/storage/img/general_blogs/blog-default-featured-image.png';
						}
					} else if(value.type.includes('BlogActivityNotification')) {
						if(that.blogs[i].featured_image != null) {
							that.blogs[i].featured_image = '/storage/img/blog/'+that.blogs[i].featured_image;
						} else {
							that.blogs[i].featured_image = '/storage/img/blog/blog-default-featured-image.png';
						}
					}

					that.blogs[i].notification_id = value.id;
					that.blogs[i].notification_type = value.type;
					i++;
				});
				// console.log(that.blogs);
				that.currentID = that.blogs[0].id;
				that.refreshHtml();
			})
			.catch((error) => {
				console.log(error);
			})
        },
		showBlogDetails(div_id, id) {
            if(this.currentID == id) {
                $('#'+div_id+' .friend-details').hide();
                $('#'+div_id+' .friend-details-2').css('display', 'flex');
            }
        },
        hideBlogDetails(div_id, id) {
            if(this.currentID == id) {
                $('#'+div_id+' .friend-details').show();
                $('#'+div_id+' .friend-details-2').css('display', 'none');
            }
        },
  	}
}
</script>
