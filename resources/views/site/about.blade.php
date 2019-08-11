@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')
    
    <!--START EXPLORE PAGE-->
    <div class="about-page">
    
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
                        <h1>About Xeno</h1>
                        <div class="breadcrumbs">
                            <a href="/"><img src="{{asset('site/images/home-solid.svg')}}"></a>
                            <i class="fas fa-angle-right"></i>
                            <span>About Xeno</span>
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
        
        <div class="page-content-section">
            <div class="container">
                <div class="row">
                    <input type="hidden" id="active-pane-id" value="">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="row">
                            <div class="sidebar">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" 
                                aria-orientation="vertical">
                                    @foreach ($abouts as $i => $about)
                                    <a class="nav-link" id="id-{{$i}}-tab"
                                    data-toggle="pill" href="#id-{{$i}}"
                                    role="tab" aria-controls="id-{{$i}}" aria-selected="true">
                                        <span>{{$about->title}}</span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-content">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @foreach ($abouts as $i => $about)
                                        <div class="tab-pane fade" id="id-{{$i}}" role="tabpanel" aria-labelledby="id-{{$i}}-tab">
                                            <h5 class="title">{{$about->title}}</h5>
                                            <div class="content">
                                                <p>
                                                    {!!$about->paragraph!!}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
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