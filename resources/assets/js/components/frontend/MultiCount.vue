<style>
.arrow-left {
    position: absolute;
    left: 0.5%;
    bottom: 1%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 3vw;
    color: #0ea69d;
    transform: scaleX(-1);
    -webkit-filter: drop-shadow(0px 0px 3px #ffffff87);
    filter: drop-shadow(0px 0px 3px #ffffff87);
}
.arrow-right {
    position: absolute;
    right: 0.5%;
    bottom: 1%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 3vw;
    color: #0ea69d;
    -webkit-filter: drop-shadow(0px 0px 3px #ffffff87);
    filter: drop-shadow(0px 0px 3px #ffffff87);
}
</style>
<template>
<div>
    <div class="blog-search">
        <form @submit.prevent="search">
            <div class="search-form">
                <div class="search-input-fields">
                    <input type="text" class="form-control" placeholder="Search" name="search" v-model="fields.search" autocomplete="off">
                    <div class="input-group-prepend status-div">
                        <select class="custom-select" id="inputGroupSelect02" name="status" v-model="fields.status" >
                            <option selected value="">Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                            <!-- {{-- <option value="Unpublished">Unpublished</option> --}} -->
                        </select>
                    </div>
                    <div class="input-group-prepend sort-div">
                        <select class="custom-select" id="inputGroupSelect02" name="sort" v-model="fields.sort" >
                            <option selected value="">Sort</option>
                            <option value="asc_name">Ascending Blog Title</option>
                            <option value="desc_name">Descending Blog Title</option>
                            <option value="asc_publisheddate">Ascending Date Published</option>
                            <option value="desc_publisheddate">Descending Date Published</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn search-btn">Search</button>
            </div>
        </form>
    </div>
    <div class="wrapper">
        <div class="blog-cols">
            <template v-if="this.blogs.total != 0">
                <div v-for="(blog,index) in blogs" :key="index" class="blog-col" ontouchstart="this.classList.toggle('hover');">
                    <div v-if='!blog.shared' class="container">
                        <div class="front" :style="getimage(blog.featured_image)">
                            <div class="inner">
                                <span v-if="blog.status == 'Published'" class="blog-status published">{{blog.status}}</span>
                                <span v-else class="blog-status draft">{{blog.status}}</span>
                                <span v-if="blog.publish_datetime != ''" class="blog-date">{{blog.formatted_time}}</span>
                                
                                <p class="blog-name">{{blog.name}}</p>
                                <span  class="blog-tags">
                                    <ul class="tags">
                                        <div v-if="blog.tags != []">
                                        <div v-for="(tag,index) in blog.tags" :key="index">
                                            <li class="tag"><i class="fas fa-tag"></i> {{tag.name}}</li>
                                        </div>
                                        <!-- <div v-if='count(blog.tags) > 2'>
                                            <li class="tag"><i class="fas fa-plus"></i> {{this.remainingcount(count(blog.tags))}}</li>
                                        </div> -->
                                        </div>
                                    </ul>
                                </span>
                                <div class="blog-buttons">
                                    <div class="button-div hotIcon">
                                        <button><img src="/front/icons/hotNew.png"/></button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.hotcount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div coolIcon">
                                        <button><img src="front/icons/coolIcon.png"/></button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.coolcount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div shareIcon">
                                        <button>
                                            <img src="front/icons/share.png" alt="" width="40">
                                        </button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.sharecount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div naffIcon">
                                        <button><img src="front/icons/naffPicked.png" width="40"/></button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.naffcount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div commentsIcon">
                                        <button>
                                            <img src="front/icons/commentsNew.png" alt="" width="40">
                                        </button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.commentcount}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <div class="blog-action-buttons">
                                    <a :href="'/single_blog/' +blog.id"><img src="front/images/blog-buttons/view-btn.png" alt="" class="view-btn"></a>
                                    <a class="delete" @click.prevent="deleteblog(blog)"><img src="front/images/blog-buttons/delete-btn.png" alt="" class="delete-btn"></a>
                                <a :href="blog.editurl"><img src="front/images/blog-buttons/edit-btn.png" alt="" class="edit-btn"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div v-else-if='blog.shared' class="container">
                        <div class="front shared-blog" :style="getsharedimage(blog)">
                            <div class="inner">
                                <span class="blog-status shared">Shared</span>
                                <span v-if="blog.publish_datetime != ''" class="blog-date">{{blog.formatted_time}}</span>
                                
                                <p class="blog-name">{{blog.name}}</p>
                                <span  class="blog-tags">
                                    <ul class="tags">
                                        <div v-if="blog.tags != []">
                                        <div v-for="(tag,index) in blog.tags" :key="index">
                                            <li class="tag"><i class="fas fa-tag"></i> {{tag.name}}</li>
                                        </div>
                                        <!-- <div v-if='count(blog.tags) > 2'>
                                            <li class="tag"><i class="fas fa-plus"></i> {{this.remainingcount(count(blog.tags))}}</li>
                                        </div> -->
                                        </div>
                                    </ul>
                                </span>
                               <div class="blog-buttons">
                                    <div class="button-div hotIcon">
                                        <button><img src="/front/icons/hotNew.png"/></button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.hotcount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div coolIcon">
                                        <button><img src="front/icons/coolIcon.png"/></button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.coolcount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div shareIcon">
                                        <button>
                                            <img src="front/icons/share.png" alt="" width="40">
                                        </button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.sharecount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div naffIcon">
                                        <button><img src="front/icons/naffPicked.png" width="40"/></button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.naffcount}}</p>
                                        </div>
                                    </div>
                                    <div class="button-div commentsIcon">
                                        <button>
                                            <img src="front/icons/commentsNew.png" alt="" width="40">
                                        </button>
                                        <div class="button-details">
                                            <p class="button-number">{{blog.commentcount}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back shared-blog">
                            <div class="inner">
                                <div class="blog-action-buttons">
                                    <a :href="'/shared_blog/' +blog.shared_id"><img src="front/images/blog-buttons/view-btn.png" alt="" class="view-btn"></a>
                                    <a class="delete" @click.prevent="deleteblog(blog)"><img src="front/images/blog-buttons/delete-btn.png" alt="" class="delete-btn"></a>
                                <a :href="blog.editurl"><img src="front/images/blog-buttons/edit-btn.png" alt="" class="edit-btn"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <h2 class="no-result">No results found.</h2>
            </template>
        </div>
    </div>
    <!-- Next and Previous buttons -->
        <div v-if="last_page > 0">
        <div class="arrow-left" @click="previousPage(page)" v-if="page > 1 && page <= last_page">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
        <div class="arrow-right" @click="nextPage(page)" v-if="page < last_page">
            <i class="fas fa-chevron-circle-right"></i>
        </div>
        </div>
    <!-- Next and Previous buttons -->
</div>
</template>
<script>
export default {
  
    data:function() {
        return{
            blogs:[],
            fields: {},
            next: false,
            last_page: '',
            page: 1,
        }
      },
    mounted () {
    this.getblogs();
    // console.log("mounted");
    // Echo.channel('blogsharecount'+this.blog_id)
    //         .listen('NewBlogShare',(e) => {
    //         this.countshares();
    //         });
    //  Echo.channel('blog'+this.blog_id)
    //   .listen('NewComment',(comment) => {
    //       this.countcomments();
    //   });
    // Echo.channel('blogLike'+this.blog_id)
    // .listen('NewEmotion',(like) => {
    //     console.log("listned");
    //     this.countemotions();
    // });
  },
    methods: {
        countemotions(index) {
        
        // debugger;
        // console.log(this.blogs[index].id);
    axios.post('/api/countemotions', {
        blog_id: this.blogs[index].id,
    })
            .then((response) => {
                this.blogs[index].hotcount= response.data.hot;
                this.blogs[index].coolcount= response.data.cool;
                this.blogs[index].naffcount= response.data.naff;

                })
            .catch(function (error) {
            console.log(error);
            });  
    },

    countcomments(index) {
        // debugger;
    axios.post('/api/countcomments', {
        blog_id: this.blogs[index].id,
    })
            .then((response) => {
                this.blogs[index].commentcount= response.data;
                })
            .catch(function (error) {
            console.log(error);
            });  
    },
    countshares(index) {
        // debugger;
      axios.get("/api/countblogshare/"+this.blogs[index].id)
        .then((response) => {
          // alert(response.data);
        //   debugger;
          this.blogs[index].sharecount = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    search() {
      this.errors = {};
      axios.post('/getblogs', this.fields)
      .then(response => {
          this.blogs = response.data.data;
        //   console.log(response.data);
          this.page = response.data.current_page;
		  this.last_page = response.data.last_page;
      })
      .catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        }
      });
    },
    getblogs() {
        var that = this;
      axios.post("/getblogs")
        .then((response) => {
        //   this.blogs = response.data.data;
        //   console.log(this.blogs);
        //   debugger;
          this.page = response.data.current_page;
        //   console.log(this.page);
          this.last_page = response.data.last_page;
          var i = 0;
          $.each(response.data.data, function(index,value) {
                if(value.blog) {
                    that.$set(that.blogs, i, value.blog);
                    that.blogs[i].shared = true;
                    that.blogs[i].shared_id = value.id;
                    that.blogs[i].type = value.blog_type;
                } else {
                    that.$set(that.blogs, i, value);
                    that.blogs[i].shared = false;
                    that.blogs[i].type = '';
                }
                that.changes(i);
                i += 1;
            });
            // console.log(this.blogs);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changes(index) {
        // console.log(this.blogs[index].id);
        // debugger;
        
            Echo.channel('blogsharecount'+this.blogs[index].id)
            .listen('NewBlogShare',(e) => {
            this.countshares(index);
            });
            Echo.channel('blog'+this.blogs[index].id)
            .listen('NewComment',(comment) => {
                this.countcomments(index);
            });
            Echo.channel('blogLike'+this.blogs[index].id)
            .listen('NewEmotion',(like) => {
                // console.log("listned");
                this.countemotions(index);
            });
        
    
    },
    remainingcount(total) {
      if(total > 2){
          return total-2;
      }else if(total == 2){
          return '';
      }else{
          return '';
      }
    },
    getimage(img) {
			return {
				'background-image':'url(storage/img/blog/'+img+')'
			};
        },
    getsharedimage(blog) {
        // debugger;
        // console.log(blog);
        if(blog.type != ''){
            if(blog.type.includes('GeneralBlog')){
            return {
				'background-image':'url(storage/img/general_blogs/'+blog.featured_image+')'
            };
            }
            else{
			return {
				'background-image':'url(storage/img/blog/'+blog.featured_image+')'
            };
        }
        }
        else{
			return {
				'background-image':'url(storage/img/blog/'+blog.featured_image+')'
            };
        }
        },
        nextPage(page) {
            var that = this;
			axios.post(`/getblogs?page=${page + 1}`)
			.then((response) => {
				// console.log(response);
				that.page = page + 1;
				that.blogs = [];
				var i = 0;
          $.each(response.data.data, function(index,value) {
                if(value.blog) {
                    that.$set(that.blogs, i, value.blog);
                    that.blogs[i].shared = true;
                    that.blogs[i].shared_id = value.id;
                    that.blogs[i].type = value.blog_type;
                } else {
                    that.$set(that.blogs, i, value);
                    that.blogs[i].shared = false;
                    that.blogs[i].type = '';
                }
                that.changes(i);
                i += 1;
            });
				// this.refreshHtml();
			//  this.getuser(response.data.data)
			})
			.catch((error) => {
				console.log(error);
			})
		},
		previousPage(page) {
            var that = this;
			axios.post(`/getblogs?page=${page - 1}`)
			.then((response) => {
				// console.log(response);
				that.page = page - 1;
				that.blogs = [];
				var i = 0;
          $.each(response.data.data, function(index,value) {
                if(value.blog) {
                    that.$set(that.blogs, i, value.blog);
                    that.blogs[i].shared = true;
                    that.blogs[i].shared_id = value.id;
                    that.blogs[i].type = value.blog_type;
                } else {
                    that.$set(that.blogs, i, value);
                    that.blogs[i].shared = false;
                    that.blogs[i].type = '';
                }
                that.changes(i);
                i += 1;
            });
			})
			.catch((error) => {
				console.log(error);
			})
        },
        deleteblog(blog) {
            var that = this;
            const Swal = require('sweetalert2')
            swal.fire({
            text: "Are you sure you want to delete this blog?",
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                width: '30%',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.78)',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
        }).then(function (isConfirm) {
            
            if(isConfirm.value === true) {
                if(blog.shared == false){
                    axios.delete('/blogs/'+blog.id)
                .then((response) => {
                    // debugger;
                 that.blogs = [];
                 debugger;
                that.getblogs();
                Swal.fire({
                    title: '<span class="success">Success!</span>',
                    text: response.data,
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    width: '30%',
                    padding: '1rem',
                    background: 'rgb(8 64 147 / 89%)'
                })
			})
			.catch((error) => {
				console.log(error);
			})
                }
                else{
                    axios.delete('/blogs/'+blog.shared_id+'?type=shared&share_id='+blog.shared_id)
                .then((response) => {
                //     console.log(that.blogs);
                //     debugger;
                 that.blogs = [];
                //  console.log(that.blogs);
                //  debugger;
                that.getblogs();
                Swal.fire({
                    title: '<span class="success">Success!</span>',
                    text: response.data,
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    width: '30%',
                    padding: '1rem',
                    background: 'rgb(8 64 147 / 89%)'
                })
			})
			.catch((error) => {
				console.log(error);
			})
                }
            }
        });

        },
    },
}       
</script>
 