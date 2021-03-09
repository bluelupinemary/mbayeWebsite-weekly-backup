<div class="navbar-wraper">	
    <header class="clearfix">		
    </header>
    <div class="main clearfix">
        
        <div class="navbar-column">
            <div id="navbar-dl-menu" class="navbar-dl-menuwrapper">
                <button class="dl-trigger">Open Menu</button>
                <ul class="navbar-dl-menu">
                    <li>
                        <a href="{{url('/')}}">HOME</a>
                    </li>
                    <li>
                        <a href="{{url('/edit-photo')}}">MY PROFILE</a>
                        <ul class="navbar-dl-submenu">
                            <li><a href="{{url('/dashboard')}}">User Profile</a></li>
                            <li><a href="{{url('/blogs')}}">My Blogs</a></li>
                            <li><a href="{{url('/blogview/designed-panel/my')}}">My Designs</a></li>
                            <li><a href="{{url('/stories')}}">My General Blogs</a></li>
                            <li><a href="{{url('/')}}">My Story of Care</a></li>
                            <li>
                                <a href="{{url('/feetMbaye')}}" class="navbar-foot">Friends</a>
                                <ul class="navbar-dl-submenu">
                                    <li><a href="{{url('/listusers')}}">Find</a></li>
                                    <li><a href="{{url('/requests')}}">Requests</a></li>
                                    <li><a href="{{url('/earthlings_activities')}}">Activities</a></li>
                                    <li><a href="{{url('/friends')}}" class="navbar-foot">List</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">PARTICIPATE</a>
                        <ul class="navbar-dl-submenu">
                            <li><a href="{{url('/participateMbaye')}}">MBAYE PAGE</a></li>
                            <li><a href="{{url('designMbaye')}}">DESIGN PANELS</a></li>
                            <li><a href="{{url('/storyMbaye?cNo=1')}}">BUILD MBAYE</a></li>
                            <li><a href="{{url('/flowersMbaye')}}">FLOWERS OF MBAYE</a></li>
                            <li><a href="{{url('/headMbaye')}}">HEAD OF MBAYE</a></li>
                            <li><a href="{{url('/feetMbaye')}}" class="navbar-foot">FOOT OF MBAYE</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('/blogs')}}">BLOGS</a>
                        <ul class="navbar-dl-submenu">
                            <li><a href="{{url('blogview/tagwise/all?tag=career')}}">Careers</a></li>
                            <li><a href="{{url('blogview/designed-panel/all')}}">Designs</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=family_and_friends')}}">Family and Friends</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=films')}}">Films</a></li>
                            <li><a href="{{url('blogview/general/all')}}">General</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=music')}}">Music</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=mountain_and_seas')}}">Our Mountains and Seas</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=politics')}}">Politics</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=sports')}}">Sports</a></li>
                            <li><a href="{{url('blogview/tagwise/all?tag=travel')}}" class="navbar-foot">Travel</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('blogview/tagwise/all?tag=career')}}">CAREERS</a>
                            <ul class="navbar-dl-submenu">
                                <li><a href="{{url('/MbayeDesignPage')}}">Setup Profile</a>
                                    <ul class="navbar-dl-submenu">
                                        <li><a href="{{url('jobseekers/setup-profile')}}">Job-seeker</a></li>
                                        <li><a href="{{url('career/companyProfile')}}" class="navbar-foot">Employer</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{url('/designPanel')}}">List Profiles</a>
                                    <ul class="navbar-dl-submenu">
                                        <li><a href="{{url('blogview/career')}}">Job-seekers</a></li>
                                        <li><a href="{{url('blogview/career')}}" class="navbar-foot">Companies</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{url('blogview/career')}}" class="navbar-foot">Jobs</a></li>
                            </ul>
                    </li>
                    <li>
                        <a href="instructions">GUIDE</a>
                    </li>
                    <li>
                        <a href="{{url('http://inoxarabia.com/')}}">ABOUT US</a>
                    </li>
                    <li>
                        <a href="{{url('/terms')}}">TERMS</a>
                    </li>
                    <li>
                        <a href="{{url('/')}}" class="navbar-logout">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- /dl-menuwrapper -->