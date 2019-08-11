<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo">
                    <img src="{{asset('site/images/logo-hand.png')}}">
                    <span><strong>Xeno</strong> Publisher</span>
                </div>
                <div class="nav nav-tabs" role="tablist">
                    <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">LOGIN</a>
                    <a class="nav-item nav-link" id="nav-signup-tab" data-toggle="tab" href="#nav-signup" role="tab" aria-controls="nav-signup" aria-selected="false">SIGN UP</a>
                </div>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
                        <div class="pane-content" id="login_part">
                            <div class="col-12 social-login">
                                <a href="/auth/linkedin" class="btn linkedin-btn">
                                    <img src="{{asset('site/images/icons/linkedin.png')}}">
                                    <span>Login with LinkedIn</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <div class="row or">
                                    <span class="line"></span>
                                    <span class="or-text">OR</span>
                                    <span class="line"></span>
                                </div>
                            </div>
                            
                            <form id="login_form" class="col-12">
                                <div id="login_alert" class="alert-danger d-none">Email or Password is incorrect</div>
                                <div class="row form">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>EMAIL</label>
                                            <input type="text" name="login_email" placeholder="EMAIL">
                                            <div class="validationMsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="password" name="login_password" placeholder="PASSWORD">
                                            <div class="validationMsg"></div>
                                            <button type="button" class="show-hide-password" id="showLPassword">
                                                <img src="{{asset('site/images/icons/show_password.png')}}">
                                            </button>
                                            <button type="button" id="forgot_password">Forgot Password?</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn validate-ajax-submit submit-btn">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="pane-content d-none" id="forgot_part">
                            <div class="col-12 text-center">
                                <h4>
                                    <button type="button" id="back-to-login">
                                        <i class="fas fa-angle-left"></i>
                                    </button>
                                    <span> Reset Your Password</span>
                                </h4>
                                <p class="instructions">
                                    Please provide the email address you used when you signed up for your Xeno account
                                    <br>
                                    We will send you an email with a code to reset your password.
                                </p>
                            </div>
                            <div class="col-12">
                                <div id="email_unavailable" class="d-none"></div>
                                <form id="send_email" class="row form">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>EMAIL</label>
                                            <input type="text" name="forgot_email" placeholder="EMAIL">
                                            <div class="validationMsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn validate-ajax-submit submit-btn">Send Email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-signup" role="tabpanel" aria-labelledby="nav-signup-tab">
                        <div class="pane-content">
                            <div class="col-12 social-login">
                                <a href="/auth/linkedin" class="btn linkedin-btn">
                                    <img src="{{asset('site/images/icons/linkedin.png')}}">
                                    <span>Sign Up with LinkedIn</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <div class="row or">
                                    <span class="line"></span>
                                    <span class="or-text">OR</span>
                                    <span class="line"></span>
                                </div>
                            </div>
                            <form id="signup_form"  class="col-12">
                                <div class="row form">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>FULL NAME</label>
                                            <input type="text" name="signup_name" placeholder="FULL NAME">
                                            <div class="validationMsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>EMAIL</label>
                                            <input type="text" name="signup_email" placeholder="EMAIL">
                                            <div id="email_unvalid" class="alert-danger d-none">Email already exist</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>AFFILIATION</label>
                                            <input type="text" name="signup_affiliation" placeholder="AFFILIATION">
                                            <div class="validationMsg"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="password" name="signup_password" placeholder="PASSWORD" id="repPass1">
                                            <div class="validationMsg"></div>
                                            <button type="button" class="show-hide-password" id="showSPassword">
                                                <img src="{{asset('site/images/icons/show_password.png')}}">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>CONFIRM PASSWORD</label>
                                            <input type="password" name="signup_confirmpassword" placeholder="CONFIRM PASSWORD" id="repPass2">
                                            <div class="confirmationMsg"></div>
                                            <button type="button" class="show-hide-password" id="showSCPassword">
                                                <img src="{{asset('site/images/icons/show_password.png')}}">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn validate-ajax-submit submit-btn">Sign Up</button>
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

