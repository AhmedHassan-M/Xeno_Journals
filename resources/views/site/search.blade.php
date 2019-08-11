@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')
    
    <!--START SEARCH PAGE-->
    <div class="search-page">
    
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
                            <span>Searching For</span>
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
        
        <div class="searching-for-section container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <form method="POST" action="/" class="search-form col-12">
                                    {{ csrf_field() }}
                                    <label>Searching For</label>
                                    <div class="form-group">
                                        <div class="search-input">
                                            <img src="{{asset('site/images/icons/article.png')}}" class="article-icon">
                                            <input type="text" name="search_text" placeholder="Search for articles" value=" @if(isset($text)) {{$text}} @endif ">
                                            <img src="{{asset('site/images/icons/search-gray.png')}}" class="search-icon">
                                        </div>
                                        <button type="submit" class="btn search-btn">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($articles))
        <div class="search-results-section container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-content row">
                                <div class="col-12 results-summery">
                                    <p class="row">Your search matches&nbsp;<span id="resultsNumber">{{count($articles)}}</span>&nbsp;results</p>
                                </div>
                                @if(isset($journal))

                                <div class="col-12">
                                    <div class="title row">
                                        <h5>{{$journal->title}}</h5>
                                        <a href="/explore">See All</a>
                                    </div>
                                </div>
                                <div class="articles col-12">
                                    <div class="row">
                                        @foreach ($articleTypes as $type)
                                        <div class="col-12">
                                            <div class="row category">
                                                <span class="line"></span>
                                                <p class="category-title">{{$type->type}}</p>
                                                <span class="line"></span>
                                            </div>
                                            <div class="row category-articles">
                                                @foreach ($journal->article()->where('type' , $type->type)->get() as $article)
                                                <div class="col-12 article">
                                                    <div class="article-content">
                                                        <p class="article-category">
                                                            <span>{{$article->journal->title}} JOURNAL</span>
                                                        </p>
                                                        <p class="article-date">
                                                            <span>{{date("F j, Y", strtotime($article->created_at))}}</span>
                                                        </p>
                                                        <h5 class="article-title">
                                                            {{$article->title}}
                                                        </h5>
                                                        <p class="article-author">
                                                            <span class="author-name">by {{$article->user->name}}</span>
                                                            <span class="line"></span>
                                                        </p>
                                                        <p class="article-excerpt">
                                                                {!!$article->intro!!}
                                                        </p>
                                                        <p class="article-link">
                                                            <a href="/article/{{$article->id}}">
                                                                <span>See Abstract </span>
                                                                <i class="fas fa-long-arrow-alt-right"></i>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </div>

                                @else
                                @foreach($journals as $journal)

                                <div class="col-12">
                                    <div class="title row">
                                        <h5>{{$journal->title}}</h5>
                                        <a href="/explore">See All</a>
                                    </div>
                                </div>
                                <div class="articles col-12">
                                    <div class="row">
                                        @foreach ($journal->article()->where('title' , 'like' , '%'.$text.'%')->distinct()->get(['type']) as $type)
                                        <div class="col-12">
                                            <div class="row category">
                                                <span class="line"></span>
                                                <p class="category-title">{{$type->type}}</p>
                                                <span class="line"></span>
                                            </div>
                                            <div class="row category-articles">
                                                <div class="col-12 article">
                                                    @foreach($journal->article()->where('title' , 'like' , '%'.$text.'%')->where('type' , $type->type)->get() as $article)
                                                    <div class="article-content">
                                                        <p class="article-category">
                                                            <span>{{$article->journal->title}} JOURNAL</span>
                                                        </p>
                                                        <p class="article-date">
                                                            <span>{{date("F j, Y", strtotime($article->created_at))}}</span>
                                                        </p>
                                                        <h5 class="article-title">
                                                            {{$article->title}}
                                                        </h5>
                                                        <p class="article-author">
                                                            <span class="author-name">by {{$article->user->name}}</span>
                                                            <span class="line"></span>
                                                        </p>
                                                        <p class="article-excerpt">
                                                                {!!$article->intro!!}
                                                        </p>
                                                        <p class="article-link">
                                                            <a href="/article/{{$article->id}}">
                                                                <span>See Abstract </span>
                                                                <i class="fas fa-long-arrow-alt-right"></i>
                                                            </a>
                                                        </p>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!--
            END CONTENT SECTION
        -->
                
    </div>

@endsection