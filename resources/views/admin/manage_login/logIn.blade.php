@extends('layouts.master_login')

@section('content')
    <div class="container-fluid login-page">
        <div class="row">
            <form class="col-lg-4 col-md-6 col-sm-10 ml-auto mr-auto" action="/admin/login" method="POST">
                {{ csrf_field() }}  
                <div class="row header">
                    <div class="icon">
                        <img src="{{asset('/admin/images/Login_Page_lock_icon.svg')}}">
                    </div>
                    <h4 class="title">Login</h4>
                </div>
                <div class="row body">
                    <div class="col-12">
                        @if(session()->exists('errors'))
                        <div class="alert alert-danger">
                            @foreach(session()->get('errors', []) as $k => $v)
                                @foreach($v as $x => $y)
                                <p>{{ $k }} : {{ $y }}</p>
                                @endforeach
                            @endforeach
                        </div>    
                        @endif
                        @if(session()->exists('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>    
                        @endif
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input id="email" type="text" class="email" name="email" required>
                            <span class="validationMsg"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" required>
                            <span class="validationMsg"></span>
                            <a class="forgot-password" href="/forget_password/reset">Forgot Password?</a>
                            <div class="clearfix"></div>
                        </div>
                        <button type="submit" class="btn valid-submit">Login</button>
                    </div>
                </div>
                <div class="row footer">
                    <p>&copy; 2018 Copyright | All Rights Reserved</p>
                    <p>Developed By <a href="http://www.wasiladev.com" target="_blank">WasilaDev</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection