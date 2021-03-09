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
                    <div class="input-group-prepend tag-div">
                        <select class="custom-select" id="inputGroupSelect02" name="tag" v-model="tag" >
                            <option selected value="">Tag</option>
                            <option v-for="(tag,index) in tags" :key="index" :value="tag.id">{{tag.name}}</option>
                        </select>
                    </div>
                    <div class="input-group-prepend status-div">
                        <select class="custom-select" id="inputGroupSelect02" name="status" v-model="status" >
                            <option selected value="">Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                            <option value="Shared">Shared</option>
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
                        <div class="front" :style="getimage(blog.featured_image)">
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
                        <div class="back shared-blog">
                            <div class="inner">
                                <div class="blog-action-buttons">
                                    <a :href="'/shared_blog/' +blog.shared_id"><img src="front/images/blog-buttons/view-btn.png" alt="" class="view-btn"></a>
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
    <!-- Next and Previous buttons -->
        <!-- <div v-if="last_page > 0">
        <div class="arrow-left" @click="previousPage(page)" v-if="page > 1 && page <= last_page">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
        <div class="arrow-right" @click="nextPage(page)" v-if="page < last_page">
            <i class="fas fa-chevron-circle-right"></i>
        </div>
        </div> -->
    <!-- Next and Previous buttons -->
    
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
            tag: '',
            next: false,
            last_page: '',
            page: 1,
            pageCount: 1,
            currentPage: 1,
            tags: []
        }
    },
    mounted () {
        this.getblogs();
        this.getTags();
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
        generalcountemotions(index) {
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
        generalcountcomments(index) {
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
        generalcountshares(index) {
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
        getblogs() {
            var that = this;

            that.blogs = [];
            $('.no-result').text('Fetching blogs...');
            
            axios.post("/getblogs", {
                search: that.search,
                sort: that.sorted_by,
                status: that.status,
                tag: that.tag,
                page: 1
            })
            .then((response) => {
                console.log(response);
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
                        if(value.blog_type.includes('GeneralBlog')) {
                            that.blogs[i].firstTwoTags = value.firstTwoTags;
                            that.blogs[i].remainingTagCount = value.remainingTagCount;
                        }
                    } else {
                        that.$set(that.blogs, i, value);
                        that.blogs[i].shared = false;
                        that.blogs[i].type = '';
                    }
                    that.changes(i);
                    i += 1;
                });

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
            var type = this.blogs[index].type;
            console.log(this.blogs[index]);
            if(this.blogs[index].type != '' && type.includes('GeneralBlog')) {
                Echo.channel('generalblogsharecount'+this.blogs[index].id)
                .listen('NewGeneralBlogShare',(e) => {
                    this.generalcountshares(index);
                });
                Echo.channel('generalblog'+this.blogs[index].id)
                .listen('NewGeneralComment',(comment) => {
                    this.generalcountcomments(index);
                });
                Echo.channel('generalblogLike'+this.blogs[index].id)
                .listen('NewGeneralEmotion',(like) => {
                    // console.log("listned");
                    this.generalcountemotions(index);
                });
            } else {
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
                    var delete_url = '';

                    if(blog.shared) {
                        delete_url = '/blogs/'+blog.shared_id+'?type=shared&share_id='+blog.shared_id;
                    } else {
                        delete_url = '/blogs/'+blog.id;
                    }

                    axios.delete(delete_url)
                    .then((response) => {
                        // console.log(response);
                        // // debugger;
                        // that.blogs = [];
                        // //  debugger;
                        that.clickCallback(that.currentPage);
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
            });
        },
        clickCallback: function(page) {
            var that = this;

            that.blogs = [];
            $('.no-result').text('Fetching blogs...');
            

            axios.post("/getblogs", {
                search: that.search,
                sort: that.sorted_by,
                status: that.status,
                tag: that.tag,
                page: page
            })
            .then((response) => {
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
                        if(value.blog_type.includes('GeneralBlog')) {
                            that.blogs[i].firstTwoTags = value.firstTwoTags;
                            that.blogs[i].remainingTagCount = value.remainingTagCount;
                        }
                    } else {
                        that.$set(that.blogs, i, value);
                        that.blogs[i].shared = false;
                        that.blogs[i].type = '';
                    }
                    that.changes(i);
                    i += 1;
                });

                that.pageCount = parseInt(response.data.last_page);
                that.currentPage = parseInt(response.data.current_page);
            })
            .catch(function (error) {
                console.log(error);
            });
        }, 
        getTags: function() {
            axios.get("/get_tags")
            .then((response) => {
                this.tags = response.data;
            });
        }
    },
}       
</script>
 