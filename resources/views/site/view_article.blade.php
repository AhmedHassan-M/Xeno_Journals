@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')
    
    <!--START ARTICLE PAGE-->
    <div class="article-page">
    
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
                            <span>Explore Journals</span>
                            <i class="fas fa-angle-right"></i>
                            @if($article->journal)
                            <span>{{$article->journal->title}}</span>
                            @endif
                            <i class="fas fa-angle-right"></i>
                            <span>{{$article->title}}</span>
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
        
        <nav class="navbar sticky-top article-page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12 article-header">
                        <div class="types row">
                            <span class="type">{{$article->type}}</span>
                        </div>
                        <div class="title row">
                            <h4>
                                {{$article->title}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <span class="progress-bar" id="article_progress_bar"></span>
        </nav>

        <div class="container-fluid sticky-top article-date-author">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12 date-author">
                            @if($article->published_at)
                            <span class="date bold">{{date("d/m/Y", strtotime($article->published_at))}}</span>
                            @endif
                            <span>&nbsp; by &nbsp;</span>
                            <span class="author bold">{{$article->user->name}}</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid article-page-content">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="row sidebar">
                                    <div class="col-12">
                                        <div class="row nav-tabs">
                                            <div class="tabs">
                                                <button class="nav-tab active" data-represents="#abstract">
                                                    <span class="indicator"></span>
                                                    <span class="name">Article Content</span>
                                                </button>
                                                <button class="nav-tab" data-represents="#section-1">
                                                    <span class="indicator"></span>
                                                    <span class="name">Abstract</span>
                                                </button>
                                                <button class="nav-tab" data-represents="#section-2">
                                                    <span class="indicator"></span>
                                                    <span class="name">Introduction</span>
                                                </button>
                                                <button class="nav-tab" data-represents="#section-3">
                                                    <span class="indicator"></span>
                                                    <span class="name">Additional Information</span>
                                                </button>
                                                <button class="nav-tab" data-represents="#section-4">
                                                    <span class="indicator"></span>
                                                    <span class="name">Financial Disclosure</span>
                                                </button>
                                                <button class="nav-tab" data-represents="#section-5">
                                                    <span class="indicator"></span>
                                                    <span class="name">Ethics Community</span>
                                                </button>
                                                <button class="nav-tab" data-represents="#section-6">
                                                    <span class="indicator"></span>
                                                    <span class="name">References</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row download part">
                                            <p>Download This Article</p>
                                            <button type="button" class="btn btn-primary" id="downloadPDF">Download PDF</button>
                                            <a href="#" class="btn btn-secondary" onclick="this.href='data:text/html;charset=UTF-8,'+encodeURIComponent(document.documentElement.outerHTML)" download>Download HTML</a>
                                        </div>
                                        <div class="row share part">
                                            <p>Share This Article</p>
                                            <div class="icons">
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{asset('directory_here')}}" class="icon" target="_blank">
                                                    <img src="{{asset('site/images/icons/share-linkedin.png')}}" alt="">
                                                </a>
                                                <a href="http://www.facebook.com/sharer.php?u={{asset('directory_here')}}" class="icon" target="_blank">
                                                    <img src="{{asset('site/images/icons/share-facebook.png')}}" alt="Facebook">
                                                </a>
                                                <a href="https://twitter.com/share?url={{asset('directory_here')}}&amp;text=text_here&amp;hashtags=Xeno" class="icon" target="_blank">
                                                    <img src="{{asset('site/images/icons/share-twitter.png')}}" alt="">
                                                </a>
                                                <a href="https://api.whatsapp.com/send?text=text_here {{asset('directory_here')}}" class="icon" target="_blank">
                                                    <img src="{{asset('site/images/icons/share-whatsapp.png')}}" alt="">
                                                </a>
                                                <a href="#" class="icon" target="_blank">
                                                    <img src="{{asset('site/images/icons/share-copy.png')}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <!--<div class="row dates">
                                            <div class="col-6">
                                                <p>Submission Date</p>
                                                <span class="date">{{date("d/m/Y", strtotime($article->created_at))}}</span>
                                            </div>
                                            @if($article->status >= 2)
                                            <div class="col-6">
                                                <p>Approval Date</p>
                                                <span class="date">{{date("d/m/Y", strtotime($article->assigned_at))}}</span>
                                            </div>
                                            @endif
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="editor" class="d-none"></div>
                        <div class="col-md-9">
                            <div class="row article-content">
                                <div class="col-12" id="abstract" data-role="scroll-section">
                                    <h4 class="section-title">Article Content</h4>
                                </div>
                                <div class="col-12 section" id="section-1" data-role="scroll-section">
                                    <h5 class="title">Abstract</h5>
                                    <p class="content">
                                        {!!$article->abstract!!}
                                    </p>
                                </div>
                                <div class="col-12 section" id="section-2" data-role="scroll-section">
                                    <h5 class="title">Introduction</h5>
                                    <p class="content">
                                        {!!$article->intro!!}
                                    </p>
                                </div>
                                <div class="col-12 section" id="section-3" data-role="scroll-section">
                                    <h5 class="title">Additional Information</h5>
                                    <p class="content">
                                        {!!$article->additional_info!!}
                                    </p>
                                </div>
                                <div class="col-12 section" id="section-4" data-role="scroll-section">
                                    <h5 class="title">Financial Disclosure</h5>
                                    <p class="content">
                                        {{$article->financial_disclosure}}
                                    </p>
                                </div>
                                <div class="col-12 section" id="section-5" data-role="scroll-section">
                                    <h5 class="title">Ethics Community</h5>
                                    <p class="content">
                                        {!!$article->intro!!}
                                    </p>
                                </div>
                                <div class="col-12 section" id="section-6" data-role="scroll-section">
                                    <h5 class="title">References</h5>
                                    <p class="content">
                                        {!!$article->refrence!!}
                                    </p>
                                </div>
                                <div class="col-12" id="keywords">
                                    <h4 class="section-title">Keywords</h4>
                                </div>
                                <div class="col-12 keywords">
                                    @foreach($keywords as $keyword)
                                    <span class="keyword">{{$keyword}}</span>
                                    @endforeach
                                </div>
                                <div class="col-12">
                                    <h4 class="section-title">Article Dates</h4>
                                </div>
                                <div class="col-12">
                                    <div class="row dates">
                                        <div class="col-12">
                                            <p>Submission Date</p>
                                            <span class="date">{{date("d/m/Y", strtotime($article->created_at))}}</span>
                                        </div>
                                        @if($article->status >= 2)
                                        <div class="col-12">
                                            <p>Approval Date</p>
                                            <span class="date">{{date("d/m/Y", strtotime($article->assigned_at))}}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
                
    </div>

@endsection

@section('scripts')
<script>
    $('#downloadPDF').click(function () {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };

        doc.fromHTML($('.article-content').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });
</script>
@endsection