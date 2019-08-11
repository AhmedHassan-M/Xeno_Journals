@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')
    
    <!--START EXPLORE PAGE-->
    <div class="contact-page">
    
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
                        <h1>Contact Us</h1>
                        <div class="breadcrumbs">
                            <a href="/"><img src="{{asset('site/images/home-solid.svg')}}"></a>
                            <i class="fas fa-angle-right"></i>
                            <span>Contact Us</span>
                        </div>
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
        
        <div class="page-content-section container-fluid">
            <!--
                START MAP
            -->
            <div class="row">
                <div id="leafletMap"></div>
            </div>
            <!--
                END MAP
            -->

            <!--
                START CONTACT US SECTION
            -->
            <div class="row contact-us-section">
                <div class="container">
                    <div class="row page-content">
                        <div class="col-12">
                            <div class="row contact-title">
                                <h4 class="title">{{$contactUsContent->title}}</h4>
                                <div class="content">
                                    <p>
                                        {!!$contactUsContent->content!!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-3 contact-info">
                                    <div class="row block">
                                        <p class="info">
                                            <img src="{{asset('site/images/location%202.svg')}}">
                                            <span>
                                                <span class="title">Location</span>
                                                {{$contactUsContent->location}}
                                            </span>
                                        </p>
                                        <p class="info">
                                            <img src="{{asset('site/images/mail%20.svg')}}">
                                            <span>
                                                <span class="title">Email</span>
                                                {{$contactUsContent->email}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <form id="contact-us-form" class="col-lg-7 offset-lg-2 col-md-9 col-sm-12 form-container">
                                    {{ csrf_field() }}
                                    <div class="row contact-form">
                                        <div class="questions col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <p class="input required">
                                                            <select id="affiliation" name="affiliation" class="selectpicker">
                                                                <option selected disabled>Affiliation</option>
                                                                <option value="Something">Something</option>
                                                                <option value="Another Thing">Another Thing</option>
                                                                <option value="Another">Another</option>
                                                            </select>
                                                        </p>
                                                        <span id="affiliation-msg" class="validationMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <p class="input required">
                                                            <input type="text" id="subject" name="subject" placeholder="Subject" required>
                                                        </p>
                                                        <span id="subject-msg" class="validationMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group row">
                                                        <p class="input required">
                                                            <input type="text" id="namecontact" name="namecontact" placeholder="Name" required>
                                                        </p>
                                                        <span id="name-msg" class="validationMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group row">
                                                        <p class="input required">
                                                            <input type="text" id="emailcontact" class="email" name="emailcontact" placeholder="Email" required>
                                                        </p>
                                                        <span id="email-msg" class="validationMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <p class="input">
                                                            <textarea id="details" placeholder="Tell us more details" name="details"></textarea>
                                                        </p>
                                                        <span id="details-msg" class="validationMsg"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="contact-success" class="alert alert-success d-none" role="alert">
                                            Your message has been successfully received.
                                        </div>
                                    </div>
                                    <div class="button row">
                                        <button type="submit" id="contactSubmit" class="btn valid-ajax-submit">SUBMIT NOW</button>
                                        <button type="reset" class="d-none reset-btn"></button>
                                    </div>
                                </form>
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
@section('scripts')
<script>
    $('#contact-us-form').on('submit' , (e) => {
        e.preventDefault();
        var form = $('#contact-us-form');

        $.ajax({
            type: 'POST',
            url: '/contact-us',
            data: form.serialize(),
            success: function success(response) {
                console.log(response);

                if(response == 'required'){
                    $('#affiliation-msg').html('required');
                    $('#name-msg').html('required');
                    $('#email-msg').html('required');
                }else if(response == 'success'){
                    $('#contact-success').removeClass('d-none');
                    form.trigger("reset");
                    setTimeout( () => $('#contact-success').addClass('d-none') , 5000);
                }
            },
            error: function error() {
                console.log('error');
            }
        });
    });
</script>
@endsection