@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')
    
    <!--START EXPLORE PAGE-->
    <div class="download-page">
    
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
                        <h1>Download Format</h1>
                        <div class="breadcrumbs">
                            <a href="/"><img src="{{asset('site/images/home-solid.svg')}}"></a>
                            <i class="fas fa-angle-right"></i>
                            <span>Download</span>
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
            <div class="row">
                <div class="container">
                    <div class="row page-content">
                        <div class="col-12">
                            <div class="row downloads-title">
                                <div class="col-12">
                                    <h5 class="title row">Download</h5>
                                </div>
                                <div class="content col-12">
                                    <p>
                                        {!!$content->content!!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!--START LOOP-->
                            @foreach($downloads as $download)
                            <div class="download-file">
                                <div class="col-lg-2 col-md-3 col-sm-12 download-file-logo">
                                    <div class="img-container">
                                        <?php
                                            $file = $download->file;    
                                            $extension = substr($file, strpos($file, ".") + 1);
                                        ?>
                                        @if($extension == 'docx')
                                        <img class="img-responsive" src="{{asset('site/images/Microsoft_Word logo.png')}}">
                                        @elseif($extension == 'pdf')
                                        <img class="img-responsive" src="{{asset('site/images/pdf-download.png')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12 download-file-body">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-12">
                                            <div class="header">
                                                <h5 class="title">{{$download->title}}</h5>
                                                <p class="details">
                                                    <span class="category">Uploaded</span>
                                                    <span class="separator">-</span>
                                                    <span class="date">{{date("d/m/Y" , strtotime($download->created_at))}}</span>
                                                </p>
                                            </div>
                                            <div class="short-description">
                                                {{$download->description}}
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12 apply-button">
                                            @if(empty($download->file))
                                            <button class="btn" disabled>Download</button>
                                            @else
                                            <a class="btn" href="/uploads/files/{{$download->file}}" download>Download</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--END LOOP-->
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