<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset('admin/images/MCS-logo-shortcut.png')}}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--Bootstrap-->
    <link rel="stylesheet" href="{{asset('admin/css/dist/bootstrap.min.css')}}">
    <!--Main Style-->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo:400,500,600,700" rel="stylesheet">
    <!--HTML5shiv for old internet explorer browsers-->
    <!--[if lt IE 9]>
        <script src="{{asset('admin/js/plugins/html5shiv.min.js')}}"></script>
    <![endif]-->
</head>
<body>
    
    @yield('content') 
    
    <!--jQuery-->
    <script src="{{asset('admin/js/plugins/jquery-3.1.0.min.js')}}"></script>
    <!--Proper.js for Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--Bootstrap-->
    <script src="{{asset('admin/js/plugins/bootstrap.min.js')}}"></script>
    <!--Main Scripts-->
    <script src="{{asset('admin/js/functions.js')}}"></script>
    @yield('scripts')
</body>
</html>