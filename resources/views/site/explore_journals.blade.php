@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')
    
    <!--START EXPLORE PAGE-->
    <div class="explore-page">
    
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
                        <h1>Explore Journals</h1>
                        <div class="breadcrumbs">
                            <a href="/"><img src="{{asset('site/images/home-solid.svg')}}"></a>
                            <i class="fas fa-angle-right"></i>
                            <span>Explore Journals</span>
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
                                <h4 class="side-title">All Journals</h4>
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" 
                                aria-orientation="vertical">
                                    <!--for start-->
                                    @foreach ($exploreJournals as $i => $exploreJournal)
                                    <div class="side-container">
                                        <button class="side-menu-toggle">
                                            <span>{{$exploreJournal->title}}</span>
                                            <i class="fas fa-caret-right"></i>
                                        </button>
                                        <div class="side-sub-menu">
                                            @for ($j = $exploreJournal->volumes; $j > $exploreJournal->volumes - 5 && $j > 0; $j--)
                                            <a class="nav-link" id="id-{{$i}}{{$j}}-tab"
                                            data-toggle="pill" href="#id-{{$i}}{{$j}}"
                                            role="tab" aria-controls="id-{{$i}}{{$j}}" aria-selected="true">
                                                <span>Volume {{$j}}</span>
                                            </a>
                                            @endfor
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="row">
                            <form method="POST" action="/" class="search-form col-12">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="search-input">
                                        <img src="{{asset('site/images/icons/article.png')}}" class="article-icon">
                                        <input type="text" name="search_text" placeholder="Search for articles">
                                        <img src="{{asset('site/images/icons/search-gray.png')}}" class="search-icon">
                                    </div>
                                    <button type="submit" class="btn search-btn">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="page-content">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @foreach ($exploreJournals as $i => $exploreJournal)
                                        
                                        @for ($j = $exploreJournal->volumes; $j > $exploreJournal->volumes - 5 && $j > 0; $j--)
                                        @if(count($exploreJournal->article()->where('status' , 4)->get()) > 0)
                                        <div class="tab-pane fade" id="id-{{$i}}{{$j}}" role="tabpanel" aria-labelledby="id-{{$i}}{{$j}}-tab">
                                            <h5 class="title">Volume {{$j}}</h5>
                                            <div class="articles">
                                                @foreach ($exploreJournal->article()->distinct()->get(['type' , 'volume']) as $k => $article)
                                                
                                                @if($j == $article->volume)
                                                <div class="col-12">
                                                    <div class="row category">
                                                        <span class="line"></span>
                                                        <p class="category-title">{{$article->type}}</p>
                                                        <span class="line"></span>
                                                    </div>
                                                    <div class="row category-articles">
                                                        @foreach ($exploreJournal->article()->where('type' , $article->type)->where('volume' , $j)->get() as $filteredArticle)
                                                        <div class="col-12 article">
                                                            <div class="article-content">
                                                                <p class="article-category">
                                                                    <span>{{$filteredArticle->journal->title}} JOURNAL</span>
                                                                </p>
                                                                <p class="article-date">
                                                                    <span>{{date("F j, Y", strtotime($filteredArticle->published_at))}}</span>
                                                                </p>
                                                                <h5 class="article-title">
                                                                        {{$filteredArticle->title}}
                                                                </h5>
                                                                <p class="article-author">
                                                                    <span class="author-name">by {{$filteredArticle->user->name}}</span>
                                                                    <span class="line"></span>
                                                                </p>
                                                                <p class="article-excerpt">
                                                                        {!!$filteredArticle->intro!!}
                                                                </p>
                                                                <p class="article-link">
                                                                    <a href="/article/{{$filteredArticle->id}}">
                                                                        <span>See Abstract </span>
                                                                        <i class="fas fa-long-arrow-alt-right"></i>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                                
                                                @endforeach
                                            </div>
                                        </div>
                                        @else
                                        <div class="tab-pane fade" id="id-{{$i}}{{$j}}" role="tabpanel" aria-labelledby="id-{{$i}}{{$j}}-tab">
                                            
                                            <p>{{$exploreJournal->description}}</p>

                                        </div>
                                        @endif
                                        @endfor
                                        
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