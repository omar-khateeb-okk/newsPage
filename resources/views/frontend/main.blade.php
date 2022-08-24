@extends('layouts.app')

@section('styles')
<link rel="shortcut icon" href="{{ asset('tech-new/images/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('tech-new/images/apple-touch-icon.png') }}">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="{{ asset('tech-new/css/bootstrap.css') }}" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="{{ asset('tech-new/css/font-awesome.min.js') }}.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('tech-new/style.css') }}" rel="stylesheet">

<!-- Responsive styles for this template -->
<link href="{{ asset('tech-new/css/responsive.css') }}" rel="stylesheet">

<!-- Colors for this template -->
<link href="{{ asset('tech-new/css/colors.css') }}" rel="stylesheet">

<!-- Version Tech CSS for this template -->
<link href="{{ asset('tech-new/css/version/tech.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="wrapper">
    <header class="tech-header header">
        <div class="container-fluid">
            <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">

                <a class="navbar-brand" href="/"><img src="{{asset('/assets/images/sms-news-logo.png')}}" class="w-100" alt="logo"></a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav w-100 d-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>

                        <li class="nav-item dropdown has-submenu menu hidden-md-down  hidden-xs-down">
                            <a class="nav-link" href="#" id="dropdown01" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Categories</a>
                            <ul class="dropdown" aria-labelledby="dropdown01">
                                <li>
                                    <div class="container">
                                        <div class="mega-menu-content clearfix">
                                            <div class="tab">
                                                @foreach ($categories as $category)
                                                    <a href="{{route('filter.posts',['category_id'=>$category->id])}}">
                                                        <button @class(['tablinks', 'active'=> $loop->iteration == 1])
                                                                onclick="openCategory(event, 'cat{{$loop->iteration}}')"
                                                        >{{$category->name}}</button>
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('admin/dashboard')}}">Dashboard</a>
                        </li>

                        <li class="nav-item ms-auto">
                            <form action="{{ route('logout.user') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Logout
                                </button>
                            </form>
                        </li>

                            <div class="relative flex items-top justify-center min-h-screen  dark:bg-gray-700 sm:items-center ">
                                @if (Route::has('login'))
                                    <div class="hidden fixed top-0 right-0 px-6 sm:block">
                                        @auth
                                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                        @else
                                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                            @endif

                                        @endauth

                                    </div>
                            @endif
                            </div>
                        </li>
                    </ul>
                    </ul>
                </div>
            </nav>
        </div><!-- end container-fluid -->
    </header><!-- end market-header -->



    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-list clearfix">
                          @foreach($posts as $post)
                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="{{url('show-post/'.$post->id)}}" title="">
                                                <img src="{{ asset('uploads/post/'.$post->img)}}" alt="" class="img-fluid">
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <h4><a href="{{url('show-post/'.$post->id)}}" title="">{{$post->name}}</a></h4>
                                        <label>description:</label>
                                        <p>{{$post->description}}</p>
                                        <label>Tags:</label>
                                        @foreach($post->tag as $tag )
                                        <small class="firstsmall"><a class="bg-orange" href="{{route('filter.posts.tag',['tag_id'=>$tag->id])}}"
                                                                     title="">{{$tag->name}}</a></small>
                                        @endforeach
                                        <br>
                                        <label>created at:</label>
                                        <small><h8>{{$post->created_at}}</h8></small>


                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                            @endforeach
                        </div><!-- end blog-list -->
                    </div><!-- end page-wrapper -->

                    <hr class="invis">



            </div><!-- end row -->
        </div><!-- end container -->
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="widget">
                        <div class="footer-text text-left">
                            <div class="social">
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i
                                        class="fa fa-facebook"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                                        class="fa fa-twitter"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i
                                        class="fa fa-instagram"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i
                                        class="fa fa-google-plus"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i
                                        class="fa fa-pinterest"></i></a>
                            </div>

                            <hr class="invis">

                            <div class="newsletter-widget text-left">
                                <form class="form-inline">
                                    <input type="text" class="form-control" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                </form>
                            </div><!-- end newsletter -->
                        </div><!-- end footer-text -->
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="widget">
                        <h2 class="widget-title">Popular Categories</h2>
                        <div class="link-widget">
                            <ul>
                                <li><a href="#">Marketing <span>(21)</span></a></li>
                                <li><a href="#">SEO Service <span>(15)</span></a></li>
                                <li><a href="#">Digital Agency <span>(31)</span></a></li>
                                <li><a href="#">Make Money <span>(22)</span></a></li>
                                <li><a href="#">Blogging <span>(66)</span></a></li>
                            </ul>
                        </div><!-- end link-widget -->
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                    <div class="widget">
                        <h2 class="widget-title">Copyrights</h2>
                        <div class="link-widget">
                            <ul>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Advertising</a></li>
                                <li><a href="#">Write for us</a></li>
                                <li><a href="#">Trademark</a></li>
                                <li><a href="#">License & Help</a></li>
                            </ul>
                        </div><!-- end link-widget -->
                    </div><!-- end widget -->
                </div><!-- end col -->
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <div class="copyright">&copy; Tech Blog. Design: <a href="http://html.design">HTML Design</a>.</div>
                </div>
            </div>
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="dmtop">Scroll to Top</div>

</div><!-- end wrapper -->
@endsection

@section('scripts')
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src=" {{ asset('tech-new/js/jquery.min.js') }}"></script>
<script src=" {{ asset('tech-new/js/tether.min.js') }}"></script>
<script src=" {{ asset('tech-new/js/bootstrap.min.js') }}"></script>
<script src=" {{ asset('tech-new/js/custom.js') }}"></script>
@endsection
