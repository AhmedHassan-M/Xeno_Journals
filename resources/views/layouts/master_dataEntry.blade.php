<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Xeno Journals | Data Entry</title>
    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset('admin/images/logo-hand.png')}}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--Bootstrap-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/bootstrap.min.css')}}">
    <!--Bootstrap Select-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/bootstrap-select.min.css')}}">
    <!--Owl Carousel-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/dist/owl.theme.default.min.css')}}">
    <!--Dropify-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/dropify.min.css')}}">
    <!--Summernote-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/summernote-bs4.css')}}">
    <!--SweetAlert-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/sweetalert.css')}}">
    <!--Datatables-->
    <link rel="stylesheet" href="{{asset('admin/Datatables/datatables.min.css')}}">
    <!-- Dashboard Style-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dist/sass/main.css')}}">
    <!--Main Style-->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo:400,500,600,700" rel="stylesheet">
    
    <!--HTML5shiv for old internet explorer browsers-->
    <!--[if lt IE 9]>
        <script src="{{asset('admin/js/plugins/html5shiv.min.js')}}"></script>
    <![endif]-->
</head>
<body class="app sidebar-mini rtl">    
            <!-- Navbar-->
            <header class="app-header">
        <a class="app-header__logo" href="/admin/dashboard">
            <img src="{{asset('admin/images/logo.png')}}">
        </a>
      <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar">
            <i class="fas fa-bars"></i>
        </a>
      <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!--Notification Menu-->
            <li class="dropdown">
                <?php
                    $user = \App\User::find(Auth::user()->id);
                ?>
                @if(count($user->notification()->where('seen' , 0)->get()) > 0)
                <span class="notification_count">{{count($user->notification()->where('seen' , 0)->get())}}</span>
                @endif
                <a class="app-nav__item notification_item" onclick="seen()" data-toggle="dropdown" aria-label="Show notifications">
                    <i class="far fa-bell fa-lg"></i>
                </a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have {{count($user->notification()->where('seen' , 0)->get())}} new notifications.</li>
                    <div class="app-notification__content">
                        @foreach ($user->notification()->where('seen' , 0)->get() as $notification)
                        <li>
                            <a class="app-notification__item" href="{{$notification->url}}">
                                <span class="app-notification__icon">
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
                                </span>
                                <div>
                                    <p class="app-notification__message">{{$notification->text}}</p>
                                    <p class="app-notification__meta">{{timeago($notification->created_at)}}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        </div>
                    </div>
                    <li class="app-notification__footer"><a href="/all_notifications">See all notifications.</a></li>
                </ul>
            </li>
            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                    <img src="{{asset('admin/images/avatar-placeholder.png')}}">
                    <span>{{Auth::user()->email}}</span>
                    <i class="fas fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu settings-menu">
                    <li>
                        <a class="dropdown-item" href="/dashboard/profile">
                            <i class="fa fa-cog fa-lg"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/logout">
                            <i class="fas fa-sign-out-alt fa-lg"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <ul class="app-menu">
            <li>
                <a class="app-menu__item" href="/data_entry/dashboard">
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item" href="/data_entry/new_articles">
                    <span class="app-menu__label">New Article Requests</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item" href="/data_entry/InProgress_articles">
                    <span class="app-menu__label">In Progress Articles</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item" href="/data_entry/finished_articles">
                    <span class="app-menu__label">Finished Articles</span>
                </a>
            </li>
        </ul>
        <div class="copyrights">
            <p>&copy; 2019 Copyrights | All rights reserved</p>
            <p>Developed By <a href="http://wasiladev.com" target="_blank">WasilaDev</a></p>
        </div>
    </aside>
    <main class="app-content">
        @yield('content') 
    </main>
    
    
    <!--jQuery-->
    <script src="{{asset('admin/js/plugins/jquery-3.1.0.min.js')}}"></script>
    <!--Proper.js for Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--Bootstrap-->
    <script src="{{asset('admin/js/plugins/bootstrap.min.js')}}"></script>
    <!--Bootstrap Select-->
    <script src="{{asset('admin/js/plugins/bootstrap-select.min.js')}}"></script>
    <!--Datatables-->
    <script src="{{asset('admin/DataTables/datatables.min.js')}}"></script>
    <!--Dashboard Plugin-->
    <script src="{{asset('admin/js/plugins/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('admin/js/plugins/pace.min.js')}}"></script>
    <!--Chart JS-->
    <script src="{{asset('admin/js/plugins/Chart.bundle.min.js')}}"></script>
    <!--Owl Carousel-->
    <script src="{{asset('admin/js/plugins/owl.carousel.min.js')}}"></script>
    <!--Dropify-->
    <script src="{{asset('admin/js/plugins/dropify.min.js')}}"></script>
    <!--Summernote-->
    <script src="{{asset('admin/js/plugins/summernote-bs4.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!--SweetAlert-->
    <script src="{{asset('admin/js/plugins/sweetalert.min.js')}}"></script>
    <!--Main Scripts-->
    <script src="{{asset('admin/js/functions.js')}}"></script>
    
    @yield('scripts')
</body>
</html>