@extends ('backend.layouts.app')
@section('before-styles')
<style>
.date {
    list-style: none;
}
.card.card-white.post div:first-child{
    display: flex;
}
.card-white  .card-heading {
  color: #333;
  background-color: #fff;
  border-color: black;
   border: 1px solid black;
}
.card-white  .card-footer {
  background-color: #fff;
  border-color: #ddd;
}
.card-white .h5 {
    font-size:14px;
    //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.card-white .time {
    font-size:12px;
    //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.post .post-heading {
  /* height: 95px; */
  /* padding: 0px 15px; */
  padding-top: 5px;
    padding-left: 10px;
}
.post .post-heading .avatar {
  width: 60px;
  height: 60px;
  display: block;
  margin-right: 15px;
}
.post .post-heading .meta .title {
  margin-bottom: 0;
}
.post .post-heading .meta .title a {
  color: black;
}
.post .post-heading .meta .title a:hover {
  color: #aaaaaa;
}
.post .post-heading .meta .time {
  margin-top: 8px;
  color: #999;
}
.post .post-image .image {
  width: 100%;
  height: auto;
}
.post .post-description {
    padding: 0px 5px 5px 5px;
}
.post .post-description p {
  font-size: 14px;
  padding-left: 75px;
}
.post .post-description .stats {
  margin-top: 20px;
}
.post .post-description .stats .stat-item {
  display: inline-block;
  margin-right: 15px;
}
.post .post-description .stats .stat-item .icon {
  margin-right: 8px;
}
.post .post-footer {
  border-top: 1px solid #ddd;
  padding: 15px;
}
.post .post-footer .input-group-addon a {
  color: #454545;
}
.post .post-footer .comments-list {
  padding: 0;
  margin-top: 20px;
  list-style-type: none;
}
.post .post-footer .comments-list .comment {
  display: block;
  width: 100%;
  margin: 20px 0;
}
.post .post-footer .comments-list .comment .avatar {
  width: 35px;
  height: 35px;
}
.post .post-footer .comments-list .comment .comment-heading {
  display: block;
  width: 100%;
}
.post .post-footer .comments-list .comment .comment-heading .user {
  font-size: 14px;
  font-weight: bold;
  display: inline;
  margin-top: 0;
  margin-right: 10px;
}
.post .post-footer .comments-list .comment .comment-heading .time {
  font-size: 12px;
  color: #aaa;
  margin-top: 0;
  display: inline;
}
.post .post-footer .comments-list .comment .comment-body {
  margin-left: 50px;
}
.post .post-footer .comments-list .comment > .comments-list {
  margin-left: 50px;
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
/* blog buttons section */
.blog-buttons {
    /* border: 1px solid red; */
    text-align: center;
    display: -webkit-box;   /* OLD - iOS 6-, Safari 3.1-6, BB7 */
    display: -ms-flexbox;  /* TWEENER - IE 10 */
    display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
    display: flex;
    justify-content: space-evenly;
    -webkit-transition: opacity 1000s;
    -moz-transition: opacity 1000s;
    -o-transition: opacity 1000s;
    transition: opacity 1000s;
    flex: 100%;
    align-self: flex-end;
    /* transition: right 1s ease-in; */
    /* position: absolute;
    bottom: -30%;
    right: 0;
    left: 0; */
}

.blog-buttons button {
    color: #fff;
    background: #fff0;
    border: 0;
    font-size: 1.8em;
    /* margin: 0% 3%; */
}

.blog-buttons .button-div {
    display: -webkit-box;   /* OLD - iOS 6-, Safari 3.1-6, BB7 */
    display: -ms-flexbox;  /* TWEENER - IE 10 */
    display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 20%;
    /* line-height: 1; */
    /* border: 1px solid red; */
}

.blog-buttons .button-div img {
    width: 100%;
}

.blog-buttons .button-div.naffIcon img {
    width: 57%;
}

.blog-buttons .button-div.shareIcon img {
    width: 60%;
}

.blog-buttons .button-div.commentsIcon img {
    width: 70%;
}

.blog-buttons .button-details {
    -ms-flex-item-align: center;
        -ms-grid-row-align: center;
            align-self: center;
}

.button-details p {
    font-size: 0.8em;
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
              @include('backend.carestory.partials.carestory-header-buttons')
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="blog_post"> <a><img src="{{ asset('storage/img/story_of_care/'.$carestory->featured_image) }}" alt="" class="img-responsive"></a>
                <div class="blog_post_detail">
                  <h3> <a href="bloginner.html">{{ $carestory->name }}</a></h3>
                  <p>{!! nl2br($carestory->content) !!}</p>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection