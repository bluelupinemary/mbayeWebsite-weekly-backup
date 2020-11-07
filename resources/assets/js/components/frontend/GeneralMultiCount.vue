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
        <form @submit.prevent="getblogs">
            <div class="search-form">
                <div class="search-input-fields">
                    <input type="text" class="form-control" placeholder="Search" name="search" v-model="search" autocomplete="off">
                    <div class="input-group-prepend status-div">
                        <select class="custom-select" id="inputGroupSelect02" name="status" v-model="status">
                            <option selected value="">Status</option>
                            <option value="Published">Published</option>
                            <option value="Shared">Shared</option>
                            <!-- {{-- <option value="Unpublished">Unpublished</option> --}} -->
                        </select>
                    </div>
                    <div class="input-group-prepend sort-div">
                        <select class="custom-select" id="inputGroupSelect02" name="sort" v-model="sorted_by" >
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
            <template v-if="blogs.length > 0">
                <div v-for="(blog,index) in blogs" :key="index" v-for-callback="{key: index, array: blogs, callback: callback}" class="blog-col" ontouchstart="this.classList.toggle('hover');">
                    <div v-if='!blog.shared' class="container">
                        <div :class="'front '+(blog.nearexpire ? 'nearly-expired' : '')" :style="getimage(blog.featured_image)">
                            <div class="inner">
                                <span v-if="blog.status == 'Published'" class="blog-status published">{{blog.status}}</span>
                                <span v-else class="blog-status draft">{{blog.status}}</span>
                                <span class="blog-date">{{blog.publish_datetime | moment('MMMM D, YYYY')}}</span>
                                
                                <p class="blog-name">{{blog.name}}</p>
                                <div class="blog-tags">
                                    <ul class="tags">
                                        <li v-for="(tag,index) in blog.firstTwoTags" :key="index" class="tag"><i class="fas fa-tag"></i> <span>{{tag.name}}</span></li>
                                        <li v-if="blog.remainingTagCount > 0" class="tag"><i class="fas fa-plus"></i> <span>{{blog.remainingTagCount}}</span></li>
                                    </ul>
                                </div>
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
                        <div :class="'back '+(blog.nearexpire ? 'nearly-expired' : '')">
                            <div class="inner">
                                <div class="blog-action-buttons">
                                    <a :href="'/single_general_blog/' +blog.id"><img src="front/images/blog-buttons/view-btn.png" alt="" class="view-btn"></a>
                                    <a class="delete" @click.prevent="deleteblog(blog)"><img src="front/images/blog-buttons/delete-btn.png" alt="" class="delete-btn"></a>
                                    <a :href="blog.editurl"><img src="front/images/blog-buttons/edit-btn.png" alt="" class="edit-btn"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div v-else-if='blog.shared' class="container">
                        <div :class="'front shared-blog '+(blog.nearexpire ? 'nearly-expired' : '')" :style="getsharedimage(blog)">
                            <div class="inner">
                                <span class="blog-status shared">Shared</span>
                                <span v-if="blog.publish_datetime != ''" class="blog-date">{{blog.publish_datetime | moment('MMMM D, YYYY')}}</span>
                                
                                <p class="blog-name">{{blog.name}}</p>
                                <span  class="blog-tags">
                                    <ul class="tags">
                                        <li v-for="(tag,index) in blog.firstTwoTags" :key="index" class="tag"><i class="fas fa-tag"></i> <span>{{tag.name}}</span></li>
                                        <li v-if="blog.remainingTagCount > 0" class="tag"><i class="fas fa-plus"></i> <span>{{blog.remainingTagCount}}</span></li>
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
                        <div :class="'back shared-blog '+(blog.nearexpire ? 'nearly-expired' : '')">
                            <div class="inner">
                                <div class="blog-action-buttons">
                                    <a :href="'/shared_story/' +blog.shared_id"><img src="front/images/blog-buttons/view-btn.png" alt="" class="view-btn"></a>
                                    <a class="delete" @click.prevent="deleteblog(blog)"><img src="front/images/blog-buttons/delete-btn.png" alt="" class="delete-btn"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <h2 class="no-result">Fetching blogs...</h2>
            </template>
        </div>
    </div>

    <nav v-if="pageCount > 1 && blogs.length > 0" class="pagination-div">
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

<script>
export default {
    data:function() {
        return{
            blogs:[],
            fields: {},
            search: '',
            status: '',
            sorted_by: '',
            next: false,
            last_page: '',
            page: 1,
            pageCount: 1,
            currentPage: 1,
            alert: 0
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
    directives: {
        forCallback(el, binding) {
            let element = binding.value
            var key = element.key
            var len = 0

            if (Array.isArray(element.array)) {
                len = element.array.length
            }

            else if (typeof element.array === 'object') {
                var keys = Object.keys(element.array)
                key = keys.indexOf(key)
                len = keys.length
            }

            if (key == len - 1) {
                if (typeof element.callback === 'function') {
                element.callback()
                }
            }
        }
    },
    methods: {
        callback() {
            $('.no-result').text('No results found.');
        },
        countemotions(index) {
            // debugger;
            // console.log(this.blogs[index].id);
            axios.post('/api/countgeneralemotions', {
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
            axios.post('/api/countgeneralcomments', {
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
            axios.get("/api/countgeneralblogshare/"+this.blogs[index].id)
            .then((response) => {
                // alert(response.data);
                //   debugger;
                this.blogs[index].sharecount = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        // search() {
        //   this.errors = {};
        //   axios.post('/getgeneralblogs', this.fields)
        //   .then(response => {
        //       this.blogs = response.data.data;
        //     //   console.log(response.data);
        //       this.page = response.data.current_page;
        // 	  this.last_page = response.data.last_page;
        //   })
        //   .catch(error => {
        //     if (error.response.status === 422) {
        //       this.errors = error.response.data.errors || {};
        //     }
        //   });
        // },
        getblogs() {
            var that = this;

            that.blogs = [];
            $('.no-result').text('Fetching blogs...');
            

            axios.post("/getgeneralblogs", {
                search: that.search,
                sort: that.sorted_by,
                status: that.status,
                page: 1
            })
            .then((response) => {
                // console.log(response);
                if(response.data.data.length == 0) {
                    $('.no-result').text('No results found.');
                }

                var i = 0;
                $.each(response.data.data, function(index,value) {
                    if(value.blog) {
                        that.$set(that.blogs, i, value.blog);
                        that.blogs[i].shared = true;
                        that.blogs[i].shared_id = value.id;
                        that.blogs[i].type = value.blog_type;
                        that.blogs[i].publish_datetime = value.publish_datetime;
                        that.blogs[i].nearexpire = value.nearexpire;
                    } else {
                        that.$set(that.blogs, i, value);
                        that.blogs[i].shared = false;
                        that.blogs[i].type = '';
                    }
                    that.changes(i);
                    i += 1;
                });

                console.log(that.blogs);

                if(response.data.alert && !that.alert) {
                    toastr.info('<strong>Notice:</strong> Tiles in <span style="text-decoration: underline;">red</span> are about to expire');
                    that.alert = 1;
                }

                that.pageCount = parseInt(response.data.last_page);
                that.currentPage = parseInt(response.data.current_page);
            })
            .catch((error) => {
                console.log(error);
            });
        },
        clickCallback: function(page) {
            var that = this;

            that.blogs = [];
            $('.no-result').text('Fetching blogs...');
            

            axios.post("/getgeneralblogs", {
                search: that.search,
                sort: that.sorted_by,
                status: that.status,
                page: page
            })
            .then((response) => {
                // console.log(response);
                if(response.data.data.length == 0) {
                    $('.no-result').text('No results found.');
                }

                var i = 0;
                $.each(response.data.data, function(index,value) {
                    if(value.blog) {
                        that.$set(that.blogs, i, value.blog);
                        that.blogs[i].shared = true;
                        that.blogs[i].shared_id = value.id;
                        that.blogs[i].type = value.blog_type;
                        that.blogs[i].publish_datetime = value.publish_datetime;
                        that.blogs[i].nearexpire = value.nearexpire;
                    } else {
                        that.$set(that.blogs, i, value);
                        that.blogs[i].shared = false;
                        that.blogs[i].type = '';
                    }
                    that.changes(i);
                    i += 1;
                });

                console.log(that.blogs);

                that.pageCount = parseInt(response.data.last_page);
                that.currentPage = parseInt(response.data.current_page);
            })
            .catch((error) => {
                console.log(error);
            });
        }, 
        changes(index) {
            // console.log(this.blogs[index].id);
            // debugger;
            
            Echo.channel('generalblogsharecount'+this.blogs[index].id)
            .listen('NewGeneralBlogShare',(e) => {
                this.countshares(index);
            });
            Echo.channel('generalblog'+this.blogs[index].id)
            .listen('NewGeneralComment',(comment) => {
                this.countcomments(index);
            });
            Echo.channel('generalblogLike'+this.blogs[index].id)
            .listen('NewGeneralEmotion',(like) => {
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
                'background-image':'url(storage/img/general_blogs/'+img+')'
            };
        },
        getsharedimage(blog) {
            // debugger;
            // console.log(blog);
            if(blog.type != ''){
                return {
                    'background-image':'url(storage/img/general_blogs/'+blog.featured_image+')'
                };
            }
        },
        nextPage(page) {
            var that = this;
			axios.post(`/getgeneralblogs?page=${page + 1}`)
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
			axios.post(`/getgeneralblogs?page=${page - 1}`)
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
                    // width: '30%',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.78)',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (isConfirm) {
            
                    if(isConfirm.value === true) {
                        if(blog.shared == false){
                            axios.delete('/general_blogs/'+blog.id)
                            .then((response) => {
                                // debugger;
                                that.blogs = [];
                                //  debugger;
                                that.getblogs();
                                Swal.fire({
                                    title: '<span class="success">Success!</span>',
                                    text: response.data.message,
                                    imageUrl: '../../front/icons/alert-icon.png',
                                    imageWidth: 80,
                                    imageHeight: 80,
                                    imageAlt: 'Mbaye Logo',
                                    // width: '30%',
                                    padding: '1rem',
                                    background: 'rgb(8 64 147 / 89%)'
                                })
                            })
                            .catch((error) => {
                                console.log(error);
                            })
                        } else {
                            axios.delete('/general_blogs/'+blog.shared_id+'?type=shared&share_id='+blog.shared_id)
                            .then((response) => {
                                //     console.log(that.blogs);
                                //     debugger;
                                that.blogs = [];
                                //  console.log(that.blogs);
                                //  debugger;
                                that.getblogs();
                                Swal.fire({
                                    title: '<span class="success">Success!</span>',
                                    text: response.data.message,
                                    imageUrl: '../../front/icons/alert-icon.png',
                                    imageWidth: 80,
                                    imageHeight: 80,
                                    imageAlt: 'Mbaye Logo',
                                    // width: '30%',
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
 