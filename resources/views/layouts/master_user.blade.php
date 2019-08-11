<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Xeno Journals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!--Leaflet js Map-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.css' rel='stylesheet' />
    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset('site/images/logo-hand.png')}}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--Bootstrap-->
    <link rel="stylesheet" href="{{asset('site/css/dist/bootstrap.min.css')}}">
    <!--Bootstrap Select-->
    <link rel="stylesheet" href="{{asset('site/css/dist/bootstrap-select.min.css')}}">
    <!--Owl Carousel-->
    <link rel="stylesheet" href="{{asset('site/css/dist/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/dist/owl.theme.default.min.css')}}">
    <!--Dropify-->
    <link rel="stylesheet" href="{{asset('site/css/dist/dropify.min.css')}}">
    <!--Summernote-->
    <link rel="stylesheet" href="{{asset('site/css/dist/summernote-bs4.css')}}">
    <!--Main Style-->
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <!--Fonts-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Archivo:400,500,600,700" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800|Roboto:300,400,700,900" rel="stylesheet">
    
    <!--HTML5shiv for old internet explorer browsers-->
    <!--[if lt IE 9]>
        <script src="{{asset('site/js/plugins/html5shiv.min.js')}}"></script>
    <![endif]-->
</head>
<body>
    <nav class="user-navbar container-fluid">
        <div class="row ws-nav d-lg-flex d-none">
            <div class="container">
                <div class="row ws-nav-container">
                    <a class="logo mr-auto img-container" href="/">
                        <img class="img-responsive" src="{{asset('site/images/logo.png')}}">
                    </a>
                    <div class="menu ml-auto d-flex justify-content-between">
                        <div class="nav-menu">
                            <ul class="nav-list">
                                <li class="nav-item explore">
                                    <button type="button" class="nav-link" id="exploreBtn">
                                        <img src="{{asset('site/images/menu.svg')}}">
                                        <span>Explore Journals</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <a href="/about_xeno" class="nav-link">About Xeno</a>
                                </li>
                            </ul>
                        </div>
                        <div class="nav-actions">
                            <ul class="nav-list">
                                @if(Auth::user()->privileges != 'D')
                                <li class="nav-item">
                                    <a href="/publish_your_article" class="nav-link publish">Publish Your Article</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <?php
                                        $user = \App\User::find(Auth::user()->id);
                                    ?>
                                    <button onclick="seen()" type="button" class="nav-link notification-btn toggle-nav-btn">
                                        <i class="far fa-bell"></i>
                                        @if(count($user->notification()->where('seen' , 0)->get()) > 0)
                                        <span id="notification_count">{{count($user->notification()->where('seen' , 0)->get())}}</span>
                                        @endif
                                    </button>
                                    <div class="notification-list user-nav-dropdown hidden">
                                        <div class="header">
                                            <p>Notifications</p>
                                        </div>
                                        <div class="last-notifications">
                                            @foreach ($user->notification()->latest()->get() as $notification)
                                            @if($notification->seen == 0)
                                            <a class="notification-item new" href="{{$notification->url}}">
                                            @elseif($notification->seen == 1)
                                            <a class="notification-item" href="{{$notification->url}}">
                                            @endif
                                                    <span class="fa-stack fa-lg">
                                                        @if($notification->type == 'contact')
                                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                                        @elseif($notification->type == 'warning')
                                                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                        <i class="far fa-hdd fa-stack-1x fa-inverse"></i>
                                                        @elseif($notification->type == 'success')
                                                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                                                        <i class="fas fa-coins fa-stack-1x fa-inverse"></i>
                                                        @endif
                                                    </span>
                                                <div class="info">
                                                    <p class="title">{{$notification->text}}</p>
                                                    <p class="date">{{date("d/m/Y", strtotime($notification->created_at))}}</p>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <button class="user-btn toggle-nav-btn">
                                        <div class="user-img">
                                            @if(!empty(Auth::user()->image))
                                            <img src="{{asset('uploads/images/'.Auth::user()->image)}}" alt="">
                                            @elseif(!empty(Auth::user()->avatar))
                                            <img src="{{Auth::user()->avatar}}" alt="">
                                            @else
                                            <img src="{{asset('site/images/profile.png')}}" alt="">
                                            @endif
                                            <span class="user-name">Hi, {{Auth::user()->first_name}}</span>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </button>
                                    <div class="user-menu user-nav-dropdown hidden">
                                        <ul>
                                            <li class="user-menu-item">
                                                @if(Auth::user()->privileges == "U" || Auth::user()->privileges == NULL)
                                                <a href="/user/profile" class="user-to-settings">
                                                @elseif(Auth::user()->privileges == "A" || Auth::user()->privileges == "D")
                                                <a href="/dashboard/profile" class="user-to-settings">
                                                @endif
                                                    <div class="user-img">
                                                            @if(!empty(Auth::user()->image))
                                                            <img src="{{asset('uploads/images/'.Auth::user()->image)}}" alt="">
                                                            @elseif(!empty(Auth::user()->avatar))
                                                            <img src="{{Auth::user()->avatar}}" alt="">
                                                            @else
                                                            <img src="{{asset('site/images/profile.png')}}" alt="">
                                                            @endif
                                                    </div>
                                                    <div class="user-info">
                                                        <p class="user-fullname">{{Auth::user()->name}}</p>
                                                        <p class="user-email">{{Auth::user()->email}}</p>
                                                    </div>
                                                </a>
                                            </li>
                                            @if(Auth::user()->privileges == "U")
                                            <li class="user-menu-item">
                                                <a href="/author/dashboard" class="user-menu-link">
                                                    <img src="{{asset('site/images/icons/dashboard.png')}}" alt="" class="icon">
                                                    <span>My Dashboard</span>
                                                </a>
                                            </li>
                                            @endif
                                            <li class="user-menu-item">
                                                <a href="/logout" class="user-menu-link">
                                                    <img src="{{asset('site/images/icons/logout.png')}}" alt="" class="icon">
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container explore-menu user-nav-dropdown hidden" id="exploreMenu">
                <span class="indicator">
                    <i class="fas fa-caret-up"></i>
                </span>
                <div class="row">
                    <div class="col-12">
                        <h6 class="row title">Explore Journals</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 explore-submenu">
                        <div class="row">
                            @foreach ($exploreJournals as $i => $exploreJournal)
                            <button class="explore-menu-item col-12" data-controls="{{$i}}">
                                {{$exploreJournal->title}}
                            </button>
                            @endforeach
                            <a href="/explore" class="explore-menu-item col-12 show-all">
                                Show All Journals &gt;
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 explore-panes">
                        <div class="row">
                            @foreach ($exploreJournals as $i => $exploreJournal)
                            <div class="col-12 pane-item pane-{{$i}}">
                                <div class="row posts-container">
                                    @foreach ($exploreJournal->article as $exploreArticle)
                                    @if($exploreArticle->status == 4)
                                    <div class="col-4 post-container">
                                        <div class="post-content">
                                            <p class="post-category">
                                                <span>{{$exploreJournal->title}} JOURNAL</span>
                                            </p>
                                            <p class="post-date">
                                                <span>{{date("F j, Y", strtotime($exploreArticle->published_at))}}</span>
                                            </p>
                                            <h6 class="post-title">
                                                {{$exploreArticle->title}}
                                            </h6>
                                            <p class="post-author">
                                                <span class="author-name">by {{$exploreArticle->user->name}}</span>
                                                <span class="line"></span>
                                            </p>
                                            <p class="post-excerpt">
                                                {!!$exploreArticle->intro!!}
                                            </p>
                                            <p class="post-link">
                                                <a href="/article/{{$exploreArticle->id}}">
                                                    <span>See Abstract </span>
                                                    <i class="fas fa-long-arrow-alt-right"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-nav d-lg-none">
            <div class="container">
                <div class="row mb-nav-container">
                    <button type="button" class="burger-menu-btn menu-closed">
                        <span class="burger-menu-bars"></span>
                    </button>
                    <div class="touchable-overlay d-none"></div>
                    <div class="logo img-container">
                        <img class="img-responsive" src="{{asset('site/images/logo.png')}}">
                    </div>
                    <a href="#" class="mb-login">
                        <img src="{{asset('site/images/user-icon-3.svg')}}">
                    </a>
                </div>
            </div>
            <div class="mb-menu">
                <ul class="nav-list">
                    <li class="nav-item my-dropdown closed">
                        <p class="dropdown-text">
                            <span class="nav-link">Explore Journals</span>
                            <i class="fas fa-angle-down"></i>
                        <ul class="my-dropdown-menu">
                            @for ($i = 1; $i < 6; $i++)
                            <li class="my-dropdown-item">
                                <a href="#" class="dropdown-link nav-link">Xeno Journals</a>
                            </li>
                            @endfor
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/about_xeno" class="nav-link">About Xeno</a>
                    </li>
                    @if(Auth::user()->privileges != 'D')
                    <li class="nav-item">
                        <a href="/publish_your_article" class="nav-link">Publish Your Article</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="container-fluid">
        <div class="row" id="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 footer-block">
                       <div class="row">
                            <div class="col-12">
                                <h6 class="title">Journals</h6>
                                <div class="row">
                                    @foreach($exploreJournals as $exploreJournal)
                                    <div class="col-6">
                                        <a href="/explore">{{$exploreJournal->title}}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                       </div> 
                    </div>
                    <div class="col-md-4 col-sm-12 footer-block">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h6 class="title">More</h6>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-6">
                                        <a href="/about_xeno">About Xeno</a>
                                    </div>
                                    @if(Auth::user()->privileges != 'D')
                                    <div class="col-sm-12 col-xs-6">
                                        <a href="/publish_your_article">Publish Your Article</a>
                                    </div>
                                    @endif
                                    <div class="col-sm-12 col-xs-6">
                                        <a href="/download_center">Download Format</a>
                                    </div>
                                    <div class="col-sm-12 col-xs-6">
                                        <a href="/contact_us">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <h6 class="title">Follow Us</h6>
                                <div class="social-links">
                                    <a href="#" target="_blank">
                                        <img src="{{asset('site/images/icons/facebook.png')}}">
                                    </a>
                                    <a href="#" target="_blank">
                                        <img src="{{asset('site/images/icons/twitter.png')}}">
                                    </a>
                                    <a href="#" target="_blank">
                                        <img src="{{asset('site/images/icons/linkedin.png')}}">
                                    </a>
                                </div>
                            </div>
                       </div> 
                    </div>
                    <div class="col-md-3 offset-md-1 col-sm-12 footer-block">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="title">Subscribe Now</h6>
                                <form id="subscribe-form" class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" name="subscribe_email" placeholder="EMAIL" required>
                                            <button type="submit" id="subscribeBtn">
                                                <i class="fas fa-long-arrow-alt-right"></i>
                                            </button>
                                        </div>
                                        <div id="subscribe-alert" class="form-group d-none">You have subscribed successfully</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="copyrights">
            <div class="col-12">
                <p class="text-center">
                    <span class="xeno">
                        &copy; 2019 Xeno Pubisher, All rights reserved.
                    </span>
                    <span class="wasila">
                        Developed By <a href="http://wasiladev.com" target="_blank">WasilaDev</a>
                    </span>
                </p>
            </div>
        </div>
    </footer>
    
    <!--jQuery-->
    <script src="{{asset('site/js/plugins/jquery-3.1.0.min.js')}}"></script>
    <!--Proper.js for Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--Bootstrap-->
    <script src="{{asset('site/js/plugins/bootstrap.min.js')}}"></script>
    <!--Bootstrap Select-->
    <script src="{{asset('site/js/plugins/bootstrap-select.min.js')}}"></script>
    <!--Owl Carousel-->
    <script src="{{asset('site/js/plugins/owl.carousel.min.js')}}"></script>
    <!--Dropify-->
    <script src="{{asset('site/js/plugins/dropify.min.js')}}"></script>
    <!--Summernote-->
    <script src="{{asset('site/js/plugins/summernote-bs4.min.js')}}"></script>
    <!--Leaflet js Map-->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.js'></script>
    <!-- reCAPTCHA -->
    <!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script> -->
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <!--Main Scripts-->
    <script src="{{asset('site/js/main.js')}}"></script>
    <script>
        $('#subscribe-form').on('submit' , (e) => {
            e.preventDefault();

            const form = $('#subscribe-form');

            $.ajax({
                type: 'POST',
                url: '/subscribe',
                data: form.serialize(),
                success: function success(response) {
                    console.log(response);

                    $('#subscribe-alert').removeClass('d-none');
                    setTimeout( () => $('#subscribe-alert').addClass('d-none') , 5000);

                    form.trigger("reset");
                },
                error: function error() {
                    console.log('error');
                }
            });
        })    
    </script>
    <script src="{{asset('site/js/functions.js')}}"></script>
    @yield('scripts')
</body>
</html>