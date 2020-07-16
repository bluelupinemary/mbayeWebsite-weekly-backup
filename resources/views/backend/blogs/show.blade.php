@extends ('backend.layouts.app')
@section('before-styles')
<style>
.date {
    list-style: none;
}
.blog-tags {
    color: #fff;
    /* margin-top: 1%; */
    font-size: 0.6rem;
    /* display: none; */
    /* height: 4vh; */
    /* overflow-y: auto; */
    /* border: 1px solid rebeccapurple; */
    /* margin-bottom: 2%; */
    /* flex: 100%; */
}

.tags {
    list-style: none;
    margin: 0;
    /* overflow: hidden; */
    padding: 0;
    display: -webkit-box;   /* OLD - iOS 6-, Safari 3.1-6, BB7 */
    display: -ms-flexbox;  /* TWEENER - IE 10 */
    display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-flow: row wrap;
            flex-flow: row wrap;
    /* flex-wrap: wrap;   */
}

.tag {
    background: #2d3339;
    border-radius: 3em;
    color: #999;
    /* display: inline-block; */
    /* height: 26px; */
    line-height: 3em;
    padding: 0 2%;
    /* position: relative; */
    /* margin: 0 2% 2% 0; */
    text-decoration: none;
    white-space: nowrap;
    font-size: 11px;
}
.blog_post {
	margin:0 0 40px 0;
	padding:0;
	border:1px solid #cce0e4;
}
.blog_post img {
	width:100%;
}
.blog_post_detail {
	background: white none repeat scroll 0 0;
	margin: 0;
	padding: 40px;
	width: 100%;
	text-align:left;
}
.blog_post_detail h3 {
	color: #532f24;
	font-family: 'Oswald';
	font-weight:bold;
	font-size: 30px;
	margin: 0 0 10px;
	padding: 0;
	text-transform: uppercase;
}
.blog_post_detail h3 a {
	color: #0380ec;
	font-family: 'Lato-Regular';
	font-weight:bold;
	font-size: 30px;
	margin: 0 0 10px;
	padding: 0;
	text-transform: uppercase;
	border:none;
	background:none;
}
.blog_post_detail h3 a:hover {
	background:none;
	color:#ec6307;
}
</style>
@endsection
@section ('title', trans('labels.backend.blogs.management') . ' | ' . trans('labels.backend.blogs.view'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.blogs.management') }}
        <small>{{ trans('labels.backend.blogs.view') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.blogs.view') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.blogs.partials.blogs-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="blog_post"> <a><img src="{{ asset('storage/img/blog/'.$blog->featured_image) }}" alt="" class="img-responsive"></a>
                <div class="blog_post_detail">
                  <h3> <a href="bloginner.html">{{ $blog->name }}</a></h3>
                    <div class="blog-tags">
                        <ul class="tags">
                            @foreach($blog->tags as $tag)
                                <li class="tag"><i class="fas fa-tag"></i> {{ $tag->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                  <p>{!! nl2br($blog->content) !!}</p>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection