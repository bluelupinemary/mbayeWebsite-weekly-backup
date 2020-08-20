<template>
    <div class="most-naffed" v-if="most_naffed_blogs.length">
        <span class="title_text">Most Naffed</span>
        <div class="container-fluid">
            <div id="carouselExample" class="carousel slide" data-interval="false">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <div v-for="(blog,index) in most_naffed_blogs" :key="index" :class="'carousel-item col-md-4 carousel-'+index+' '+isActive(index)" @click.prevent="viewBlog(blog.id)">
                        <h2 v-if="index==0" class="blog_name" :id="'blog_name_h'+index">Most Naffed!</h2>
                        <h2 v-else-if="index==1" class="blog_name" :id="'blog_name_h'+index">2nd Most Naffed!</h2>
                        <h2 v-else-if="index==2" class="blog_name" :id="'blog_name_h'+index">3rd Most Naffed!</h2>
                        <h2 v-else class="blog_name" :id="'blog_name_h'+index">{{index+1+((current_page-1)*3)}}th Most Naffed!</h2>
                        <h2 class="naff_count" :id="'blog_name_'+index">
                            <span style="color:#28e9e2 !important">Naff Count: </span> 
                            <span style="color:gold !important">{{blog.naff_likes_count}}</span>
                        </h2>
                        <img :src="'/storage/img/general_blogs/'+blog.featured_image"  id="1" :class="'img-fluid mx-auto d-block img-responsive img-responsive-'+index" @load="layoutCell('img-responsive-'+index, index)">
                    </div>
                    <!-- <div class="carousel-item col-md-3 active">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400/000/fff?text=1" alt="slide 1">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=2" alt="slide 2">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=3" alt="slide 3">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=4" alt="slide 4">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=5" alt="slide 5">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=6" alt="slide 6">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=7" alt="slide 7">
                    </div>
                    <div class="carousel-item col-md-3">
                        <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=8" alt="slide 7">
                    </div> -->
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <i class="fa fa-chevron-left fa-lg text-muted"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next" @click="nextSlide">
                    <i class="fa fa-chevron-right fa-lg text-muted"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data:function() {
        return {
            ClickCount: 0,
            last_page:'',
            Total_pages:0,
            Total_count:0,
            current_page:1,
            page:1,
            last_page:0,
            most_naffed_blogs: [],
            carousel_num: 2,
            blog_nam: '',
            naff_count: '',
        }
    },
    mounted() {
        this.fetchMostNaffed();
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
            
        },
        fetchMostNaffed() {
            let that = this;
            axios.get("/fetchmostnaff?page="+that.page)
                .then((response) => {
                    console.log(response.data);
                    that.most_naffed_blogs = response.data;
                    // that.current_page = response.data.current_page;
                    // that.last_page = response.data.last_page;
                    console.log(that.most_naffed_blogs);

                    // var i;
                    // for(i = 0; i < that.arrCount.length; i++) {
                    //     new CircleType(document.getElementById('blog_name_h'+i))
                    //     .dir(1)
                    //     .radius(60);

                    //     new CircleType(document.getElementById('blog_name_'+i))
                    //     .dir(-1)
                    //     .radius(60);
                    // }
                    
                    // $.each(that.arrCount, function(index, value) {
                    //     console.log('naff_likes: '+value.naff_likes_count);
                    // });
                }
            );
        },
        nextSlide() {
            let that = this;
            // if(that.page < that.last_page) {
            //     that.page = that.page+1;

            //     axios.get("/fetchmostnaff?page="+that.page)
            //         .then((response) => {
            //             console.log(response.data);
            //             that.arrCount = response.data.data;
            //             that.current_page = response.data.current_page;
            //             console.log(that.arrCount);
            //             // $.each(that.arrCount, function(index, value) {
            //             //     console.log('naff_likes: '+value.naff_likes_count);
            //             // });
            //         }
            //     );
        },
        prevSlide() {
            if(this.current_page > 1) {
                this.current_page -= 1;
                this.page -= 1;
            }
        },
        layoutCell(img_class, index) {
            let that = this;
            var iwidth = $('.'+img_class).width();
            var iheight = $('.'+img_class).height();
            var blog_name_id = 'blog_name_h'+index;
            var naff_count_id = 'blog_name_'+index;

            var blog_name = '';
            var naff_count = '';

            $('.carousel-item').mouseover(function() {
                var iwidth = $(this).find('img').width();
                var iheight = $(this).find('img').height();
                var blog_name_id =  $(this).find('.blog_name').attr('id');
                var naff_count_id = $(this).find('.naff_count').attr('id');
                
                if(iwidth < iheight) {
                    var ratio = 4;
                } else if (iwidth > iheight) {
                    var ratio = 2;
                }

                $(this).find('.blog_name').css({
                    'top': "-"+ ((iheight/ratio)+10) + "px",
                });

                $(this).find('.naff_count').css({
                    'bottom': "-"+ ((iheight/ratio)+10) + "px",
                });

                if(blog_name == '' && naff_count == '') {
                    blog_name = new CircleType(document.getElementById(blog_name_id))
                        .dir(1)
                        .radius(60);

                    naff_count = new CircleType(document.getElementById(naff_count_id))
                        .dir(-1)
                        .radius(60);

                    $(this).find('.blog_name, .naff_count').addClass('animated zoomIn');
                    $(this).find('.blog_name, .naff_count').css('opacity', '1');
                }
            }).mouseout(function() {
                $('.blog_name, .naff_count').removeClass('animated zoomIn');
                $('.blog_name, .naff_count').css('opacity', '0');

                blog_name.destroy();
                naff_count.destroy();
                blog_name = '';
                naff_count = '';
            });
        },
        isActive(num) {
            console.log('num: ', num);
            if(num == this.current_page - 1) {
                return 'active';
            } else {
                return '';
            }
        },
        viewBlog(id) {
            window.location.href = '/single_general_blog/'+id;
        },
    }
}
</script>