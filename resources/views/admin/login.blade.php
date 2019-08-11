@extends('layouts.master_login')

@section('content')
<div class="container-fluid login-page">
        <div class="row">
            <form class="col-lg-4 col-md-6 col-sm-10 ml-auto mr-auto" method="POST">
                {{ csrf_field() }} 
                @if(session()->has('failure'))
                    <div class="alert alert-danger">
                        {{ session()->get('failure') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="row header">
                    <div class="icon">
                        <img src="http://mcs.wasiladev.com/admin/images/Login_Page_lock_icon.svg">
                    </div>
                    <h4 class="title">Login</h4>
                </div>
                <div class="row body">
                    <div class="col-12">
                        <div class="form-group" data-children-count="1">
                            <label for="email">Email ID</label>
                            <input value="{{old('email')}}" id="email" type="text" class="email" name="email" required="" data-kwimpalastatus="alive" data-kwimpalaid="1553598392264-2">
                            <span class="validationMsg"></span>
                        </div>
                        <div class="form-group" data-children-count="1">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" required="" data-kwimpalastatus="alive" data-kwimpalaid="1553598392264-3">
                            <span class="validationMsg"></span>
                            <a class="forgot-password" href="/send-email">Forgot Password?</a>
                            <div class="clearfix"></div>
                        <button type="submit" class="btn valid-submit">Login</button>
                    </div>
                </div>
                <div class="row footer">
                    <p>© 2018 Copyright | All Rights Reserved</p>
                    <p>Developed By <a href="http://www.wasiladev.com" target="_blank">WasilaDev</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection