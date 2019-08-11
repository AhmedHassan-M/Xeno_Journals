@extends('layouts.master_login')

@section('content')
    <div class="container-fluid login-page">
        <div class="row">

            <form id="send_email" class="col-lg-4 col-md-6 col-sm-10 ml-auto mr-auto" method="POST">
                {{ csrf_field() }}  
                <div class="row header">
                    <div class="icon">
                        <img src="{{asset('/admin/images/Login_Page_lock_icon.svg')}}">
                    </div>
                    <h4 class="title">Reset Password</h4>
                </div>
                <div class="row body">
                    <div clss="col-12">
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Enter Your Email</label>
                            <input id="forgot_email" type="text" class="email" value="{{ old('email') }}" name="forgot_email" required>
                            <span id="email_unavailable" class="validationMsg"></span>
                            <div class="back-msg">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                            </div>
                        </div>
                        <button type="submit" class="btn valid-submit">Send</button>
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
@section('scripts')
<script>
    $('#send_email').on('submit', function(e) {
        e.preventDefault();
        var form = $('#send_email');

        $.ajax({
                type: 'POST',
                url: '/send-email',
                data: form.serialize(),
                success: function success(response) {
                    console.log(response);

                    if(response == 'failure'){
                        $('#email_unavailable').removeClass('d-none').addClass('alert-danger').html('Email is not available');
                        setTimeout( () => $('#email_unavailable').addClass('d-none') , 5000);
                    }else if(response == 'success'){
                        form.trigger("reset");
                        $('#email_unavailable').removeClass('d-none').addClass('alert-success').html('Reset password email is sent successfully');
                        setTimeout( () => $('#email_unavailable').addClass('d-none') , 5000);
                    }
                },
                error: function error() {
                    console.log('error');
                }
            });
    }); 
</script>
@endsection