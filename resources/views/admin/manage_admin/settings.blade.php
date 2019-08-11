@extends('layouts.master_admin')

@section('content')
  <div class="page-header col-12">
            <div class="row">
                <h2>Create New Data Entry Account</h2>
                <p>From this section, you can create new data entry account</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
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
                <form method="POST" action="" class="col-12">
                    {{ csrf_field() }}
                    <div class="row content">
                        <div class="col-6">
                            <div class="form-group account">
                                <h4 class="title-contact">User Name</h4>
                                <input name="userName" type="text" placeholder="Lorem ipsum" class="form-control page-title" value="{{Auth::user()->name}}" required>
                            </div>
                            <div class="form-group account">
                                <h4 class="title-contact">Email</h4>
                                <input name="email" type="email" placeholder="Lorem ipsum" class="form-control page-title" value="{{Auth::user()->email}}" required>
                            </div>
                            <div class="form-group account">
                                <h4 class="title-contact">Password</h4>
                                <input name="password" type="password" placeholder="Lorem ipsum" class="form-control page-title password main">
                                <img src="{{asset('admin/images/icons/show-password-icon.png')}}" alt="icon" class="password-img show">
                            </div>
                            <div class="form-group account">
                                <h4 class="title-contact">Confirm password</h4>
                                <input name="confirmPassword" type="password" placeholder="Lorem ipsum" class="form-control page-title password confirm">
                                <img src="{{asset('admin/images/icons/show-password-icon.png')}}" alt="icon" class="password-img show">
                                <span class="message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button type="reset" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-create">Save</button>
                    </div>
                </form>
            </div>
            
        </div>
@endsection
