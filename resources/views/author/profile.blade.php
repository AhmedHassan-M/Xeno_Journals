@extends('layouts.master_user')

@section('content')
    
    <!--START EXPLORE PAGE-->
    <div class="user-profile-page">
    
        <!--
            START HEADER SECTION
        -->

        <div class="page-header-section">
            <div class="header-background">
                <img src="{{asset('site/images/png/hero-back.png')}}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="header">
                        <div class="breadcrumbs">
                            <a href="/"><img src="{{asset('site/images/home-solid.svg')}}"></a>
                            <i class="fas fa-angle-right"></i>
                            <span>Your Profile</span>
                        </div>
                        <h2>Hi, {{Auth::user()->first_name}}</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <!--
            END HEADER SECTION
        -->
        
        
         
        <!--
            START CONTENT SECTION
        -->
        
        <div class="page-content-section">
            <div class="container">
                
                <div class="row">
                    <input type="hidden" id="active-pane-id" value="">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        @if(session()->has('imgSuccess'))
                            <div class="alert alert-success">
                                {{ session()->get('imgSuccess') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="sidebar">
                                <div class="user_identity">
                                    <div class="user-img">
                                        <div class="img-container">
                                            @if(!empty(Auth::user()->image))
                                            <img src="{{asset('uploads/images/'.Auth::user()->image)}}" alt="">
                                            @elseif(!empty(Auth::user()->avatar))
                                            <img src="{{Auth::user()->avatar}}" alt="">
                                            @else
                                            <img src="{{asset('site/images/profile.png')}}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="user-name">
                                        <span class="name">
                                            {{Auth::user()->name}}
                                        </span>
                                    </div>
                                </div>
                                <a class="side-link" href="/user/index">
                                    <span>Back to Homepage</span>
                                </a>
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" 
                                aria-orientation="vertical">
                                    <a class="nav-link" id="id-account-tab"
                                    data-toggle="pill" href="#id-account"
                                    role="tab" aria-controls="id-account" aria-selected="true">
                                        <span>My Account</span>
                                    </a>
                                    <a class="nav-link" id="id-photo-tab"
                                    data-toggle="pill" href="#id-photo"
                                    role="tab" aria-controls="id-photo" aria-selected="true">
                                        <span>Photo</span>
                                    </a>
                                    <!--
                                    <a class="nav-link" id="id-notifications-tab"
                                    data-toggle="pill" href="#id-notifications"
                                    role="tab" aria-controls="id-notifications" aria-selected="true">
                                        <span>Notifications</span>
                                    </a>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if(session()->has('failure'))
                            <div class="alert alert-danger">
                                {{ session()->get('failure') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="page-content">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <form method="POST" class="tab-pane fade" id="id-account" role="tabpanel" aria-labelledby="id-account-tab">
                                            {{ csrf_field() }}
                                            <div class="tab-header">
                                                <div class="tab-container">
                                                    <h5 class="title">My Account</h5>
                                                    <p class="guide-text">
                                                        Add information about yourself to share on your profile.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="tab-container">
                                                    <div class="main-fields">
                                                        <div class="form-group">
                                                            <div class="input">
                                                                <input type="text" name="name" placeholder="Your Name" value="{{Auth::user()->name}}" required>
                                                            </div>
                                                            <span class="validationMsg"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input">
                                                                <input type="text" class="email" name="email" placeholder="Your Email" value="{{Auth::user()->email}}" required>
                                                            </div>
                                                            <span class="validationMsg"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input">
                                                                <input type="password" class="current-password" name="current_password" value="" placeholder="Your Current Password">
                                                                <button type="button" class="new_password_btn">
                                                                    <img src="{{asset('site/images/icons/edit-icon.png')}}" alt="">
                                                                </button>
                                                            </div>
                                                                <div class="alert alert-danger current-password-valid d-none">
                                                                    Current password is incorrect
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="new-password-fields d-none">
                                                        <div class="form-group">
                                                            <div class="input">
                                                                <input type="password" id="repPass1" name="new_password" placeholder="Enter New Password">
                                                                <button type="button" class="showPassword">
                                                                    <span class="show_icon">
                                                                        <i class="fas fa-eye"></i>
                                                                    </span>
                                                                    <span class="hide_icon d-none">
                                                                        <i class="fas fa-eye-slash"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <span class="confirmationMsg"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input">
                                                                <input type="password" id="repPass2" name="repeat_new_password" placeholder="Re-type New Password">
                                                                <button type="button" class="showPassword">
                                                                    <span class="show_icon">
                                                                        <i class="fas fa-eye"></i>
                                                                    </span>
                                                                    <span class="hide_icon d-none">
                                                                        <i class="fas fa-eye-slash"></i>
                                                                    </span>
                                                                </button>
                                                                <span class="confirmationMsg"></span>
                                                            </div>
                                                            <span class="confirmationMsg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-footer">
                                                <div class="tab-container">
                                                    <button type="submit" class="btn btn-primary save-btn">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" action="/update/profile-pic" class="tab-pane fade" id="id-photo" role="tabpanel" aria-labelledby="id-photo-tab" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="tab-header">
                                                <div class="tab-container">
                                                    <h5 class="title">Photo</h5>
                                                    <p class="guide-text">
                                                        Add a nice photo of yourself for your profile.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="tab-container">
                                                    <div class="preview-container">
                                                        <div class="preview">
                                                            <div class="img-container">
                                                                @if(!empty(Auth::user()->image))
                                                                <img src="{{asset('uploads/images/'.Auth::user()->image)}}" alt="">
                                                                @elseif(!empty(Auth::user()->avatar))
                                                                <img src="{{Auth::user()->avatar}}" alt="">
                                                                @else
                                                                <img src="{{asset('site/images/profile.png')}}" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="instructions">
                                                            <p>
                                                                Your image should be at minimum 200x200 pixels and maximum 6000x6000 pixels.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="upload-new">
                                                        <div class="form-group">
                                                            <label>Add / Change Image</label>
                                                            <div class="input input-file">
                                                                <span class="input-placeholder">No File Selected</span>
                                                                <input type="file" accept="image/*" id="userImage_uploadFile" name="user_img" placeholder="No File Selected" required>
                                                                <label for="userImage_uploadFile" class="upload-text">Upload Image</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-footer">
                                                <div class="tab-container">
                                                    <button type="submit" class="btn btn-primary save-btn">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--
            END CONTENT SECTION
        -->
                
    </div>

@endsection