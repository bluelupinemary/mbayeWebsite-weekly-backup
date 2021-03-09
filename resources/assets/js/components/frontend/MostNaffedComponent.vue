<template>
    <div class="most-naffed" v-if="most_naffed_blogs.length">
        <span class="title_text">Most Naffed</span>
        <!-- <div class="container-fluid"> -->
            <!-- <div id="carouselExample" class="carousel slide" data-interval="false">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <div v-for="(blog,index) in most_naffed_blogs" :key="index" :class="'carousel-item col-md-4 carousel-'+index+' '+isActive(index)" @click.prevent="viewBlog(blog.id)">
                        <h2 v-if="index==0" class="blog_name" :id="'blog_name_h'+index">Most Naffed!</h2>
                        <h2 v-else class="blog_name" :id="'blog_name_h'+index">{{getRank(index+1)}} Most Naffed!</h2>
                        <h2 class="naff_count" :id="'blog_name_'+index">
                            <span style="color:#28e9e2 !important">Naff Count: </span> 
                            <span style="color:gold !important">{{blog.naff_likes_count}}</span>
                        </h2>
                        <div class="slide-overlay">
                            <p v-if="index==0" class="rank" :id="'rank_'+index">Most naffed!</p>
                            <p v-else class="rank" :id="'rank_'+index">{{getRank(index+1)}} Most naffed!</p>
                            <p class="naff-count" :id="'naff_count_'+index">Naff Count: {{blog.naff_likes_count}}</p>
                        </div>
                        <img :src="'/storage/img/general_blogs/'+blog.featured_image"  id="1" :class="'img-fluid mx-auto d-block img-responsive img-responsive-'+index" @load="layoutCell('img-responsive-'+index, index)">
                    </div> -->
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
                <!-- </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <i class="fa fa-chevron-left fa-lg"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next" @click="nextSlide">
                    <i class="fa fa-chevron-right fa-lg"></i>
                    <span class="sr-only">Next</span>
                </a> -->
            <!-- </div> -->
        <!-- </div> -->
        <div class="col-md-12">
        <div class="carousel slide carousel-fade" id="myCarousel" data-interval="false" data-ride="carousel" data-pause="hover">
            <div class="carousel-inner">
            <div v-for="(blog,index) in most_naffed_blogs" :key="index" :class="'item carousel-'+index+' '+(index == 0 ? 'active' : '')" v-for-callback="{key: index, array: most_naffed_blogs, callback: callback}" @click.prevent="viewBlog(blog.id)">
                
                <div class="item-slide col-md-4" >
                    <h2 v-if="index==0" class="blog_name" :id="'blog_name_h'+index">Most Naffed!</h2>
                    <h2 v-else class="blog_name" :id="'blog_name_h'+index">{{getRank(index+1)}} Most Naffed!</h2>
                    <h2 class="naff_count" :id="'blog_name_'+index">
                        <span style="color:#28e9e2 !important">Naff Count: </span> 
                        <span style="color:gold !important">{{blog.naff_likes_count}}</span>
                    </h2>
                    
                    <a href="#">
                        <div class="slide-overlay">
                            <p v-if="index==0" class="rank" :id="'rank_'+index">Most naffed!</p>
                            <p v-else class="rank" :id="'rank_'+index">{{getRank(index+1)}} Most naffed!</p>
                            <p class="naff-count" :id="'naff_count_'+index">Naff Count: {{blog.naff_likes_count}}</p>
                        </div>
                        <img :src="'/storage/img/general_blogs/'+blog.featured_image" :class="'img-fluid mx-auto d-block img-responsive img-responsive-'+index" @load="layoutCell('img-responsive-'+index, index)">
                    </a>
                </div>
            </div>
            <!-- <div class="item active">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/bbbbbb/fff&amp;text=1" class="img-responsive"></a></div>
            </div>
            <div class="item">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/CCCCCC/fff&amp;text=2" class="img-responsive"></a></div>
            </div>
            <div class="item">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/eeeeee/fff&amp;text=3" class="img-responsive"></a></div>
            </div>
            <div class="item">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/f4f4f4/fff&amp;text=4" class="img-responsive"></a></div>
            </div>
            <div class="item">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/fcfcfc/333&amp;text=5" class="img-responsive"></a></div>
            </div>
            <div class="item">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/f477f4/fff&amp;text=6" class="img-responsive"></a></div>
            </div>
            <div class="item">
            <div class="col-md-4"><a href="#"><img src="http://placehold.it/500/f477f4/fff&amp;text=7" class="img-responsive"></a></div> -->
            </div>
        </div>
        <a v-if="most_naffed_blogs.length > 3" class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a v-if="most_naffed_blogs.length > 3" class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
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
            blog_name: '',
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
            // console.log('callback');
            // console.log($('.carousel .item-slide'));
            // $('.carousel .item-slide').each(function(){
            //     var iwidth = $(this).find('img').width();
            //     var iheight = $$(this).find('img').height();
            //     console.log('overlay: ', iwidth, iheight);
            //     $(this).find('.slide-overlay').css({
            //         'width': iwidth+'px',
            //         'height': iheight+'px',
            //     });
            // });
        },
        fetchMostNaffed() {
            let that = this;
            axios.get("/fetchmostnaff?page="+that.page)
                .then((response) => {
                    // console.log(response.data);
                    that.most_naffed_blogs = response.data;
                    // that.current_page = response.data.current_page;
                    // that.last_page = response.data.last_page;
                    // console.log(that.most_naffed_blogs);

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

            console.log('image loaded');
            // if(iwidth > 0 && iheight > 0 && (iwidth < iheight || iwidth == iheight)) {
            //         $(this).addClass('portrait');
            //     }
            // $('.'+img_class).closest('.item-slide').find('.slide-overlay').css({
            //     'width': iwidth+'px',
            //     'height': iheight+'px',
            // });

            // var blog_name = '';
            // var naff_count = '';

            $('.item-slide').mouseover(function() {
                var iwidth = $(this).find('img').width();
                var iheight = $(this).find('img').height();
                var blog_name_id =  $(this).find('.blog_name').attr('id');
                var naff_count_id = $(this).find('.naff_count').attr('id');
                var item_classes = '';

                $(this).closest('.item').attr('class').split(' ').map(function(className){     
                    item_classes += '.'+className;
                    // alert(clssName)
                });
                console.log(item_classes, item_classes+' #'+blog_name_id);

                console.log(iwidth, iheight);
                var ratio = 4;
                if(iwidth < iheight) {
                    ratio = 8;
                } else if (iwidth > iheight) {
                    ratio = 4;
                } else if (iwidth == iheight) {
                    ratio = 7;
                }

                $(this).find('.blog_name').css({
                    'top': "-"+ ((iheight/ratio)) + "px",
                });

                $(this).find('.naff_count').css({
                    'bottom': "-"+ ((iheight/ratio)) + "px",
                });
                // blog_name = '';
                // naff_count = '';
                if(that.blog_name == '' && that.naff_count == '') {
                    console.log('circle', blog_name_id, naff_count_id);
                    that.blog_name = new CircleType(document.querySelector(item_classes+' #'+blog_name_id))
                        .dir(1)
                        .radius(60);

                    that.naff_count = new CircleType(document.querySelector(item_classes+' #'+naff_count_id))
                        .dir(-1)
                        .radius(60);

                    $(this).find('.blog_name, .naff_count').addClass('animated zoomIn');
                    $(this).find('.blog_name, .naff_count').css('opacity', '1');
                }
            }).mouseout(function() {
                $('.blog_name, .naff_count').removeClass('animated zoomIn');
                $('.blog_name, .naff_count').css('opacity', '0');
                console.log('remove circle');

                if(that.blog_name && that.naff_count) {
                    that.blog_name.destroy();
                    that.naff_count.destroy();
                    
                }

                that.blog_name = '';
                    that.naff_count = '';
            });
        },
        showLabel(index) {
            alert();
            var target = $(event.target);
            console.log(index);
            var iwidth = target.width();
            var iheight = target.height();
            var blog_name_id = 'blog_name_h'+index;
            var naff_count_id = 'blog_name_'+index;
            
            if(iwidth < iheight) {
                var ratio = 4;
            } else if (iwidth > iheight) {
                var ratio = 2;
            }

            target.closest('.item-slide').find('.blog_name').css({
                'top': "-"+ ((iheight/ratio)+10) + "px",
            });

            target.closest('.item-slide').find('.naff_count').css({
                'bottom': "-"+ ((iheight/ratio)+10) + "px",
            });

            // blog_name = '';
            // naff_count = '';
            if(this.blog_name == '' && this.naff_count == '') {
                console.log('circle');
                this.blog_name = new CircleType(document.getElementById(blog_name_id))
                    .dir(1)
                    .radius(60);

                this.naff_count = new CircleType(document.getElementById(naff_count_id))
                    .dir(-1)
                    .radius(60);

                target.closest('.item-slide').find('.blog_name, .naff_count').addClass('animated zoomIn');
                target.closest('.item-slide').find('.blog_name, .naff_count').css('opacity', '1');
            }
        },
        removeLabel() {
            $('.blog_name, .naff_count').removeClass('animated zoomIn');
            $('.blog_name, .naff_count').css('opacity', '0');
            console.log('remove circle');
            this.blog_name.destroy();
            this.naff_count.destroy();
            this.blog_name = '';
            this.naff_count = '';
        },
        isActive(num) {
            // console.log('num: ', num);
            if(num == this.current_page - 1) {
                return 'active';
            } else {
                return '';
            }
        },
        viewBlog(id) {
            window.location.href = '/single_general_blog/'+id;
        },
        getRank(rank) {
            var rank = rank.toString();

            if(rank.endsWith("2")) {
                return rank+'nd';
            } else if(rank.endsWith("3")) {
                return rank+'rd';
            } else {
                return rank+'th';
            }
        }
    }
}
</script>