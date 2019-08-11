@extends('layouts.master_login')

@section('content')
    <div class="container-fluid login-page">
        <div class="row">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <form class="col-lg-4 col-md-6 col-sm-10 ml-auto mr-auto" method="POST">
                {{ csrf_field() }}  

                
                <div class="row header">
                    <div class="icon">
                        <img src="{{asset('/admin/images/Login_Page_lock_icon.svg')}}">
                    </div>
                    <h4 class="title">Reset Password</h4>
                </div>
                <div class="row body">
                    <div class="col-12">
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span class="validationMsg"></span>
                            <div class="back-msg">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <span class="validationMsg"></span>
                            <div class="back-msg">
                                @if(session()->has('failure'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('failure') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn valid-submit">Confirm</button>
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