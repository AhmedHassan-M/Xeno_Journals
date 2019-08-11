@extends('layouts.master_user')

@section('content')

<div class="container-fluid create-article-page">
    <div class="row">
        <div class="container">
            <div class="row page-content main">
               <div class="col-3">
                     <div class="row category-articles">           
                        <div class="col-12 article">
                            <div class="main-titles">
                                <h4>Latest Activity</h4>
                                <hr>
                            </div>
                            @foreach($activities as $activity)
                            <div class="article-content">
                                <p class="article-category">
                                    @if($activity->article->journal)
                                    <span>{{$activity->article->journal->title}} JOURNAL</span>
                                    @endif
                                </p>
                                <p class="article-date">
                                    @if($activity->article->status == 4)
                                    <span>{{date("F j, Y", strtotime($activity->article->published_at))}}</span>
                                    @elseif($activity->article->status == 5)
                                    <span>{{date("F j, Y", strtotime($activity->article->created_at))}}</span>
                                    @endif
                                </p>
                                <h5 class="article-title">
                                        {{$activity->article->title}}
                                </h5>
                                <p class="article-author">
                                    <span class="author-name">by {{$activity->article->user->name}}</span>
                                    <span class="line"></span>
                                </p>
                                <p class="article-link">
                                    <a href="/article/{{$activity->article->id}}">
                                        <span>Continue Reading </span>
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </p>
                            </div>
                            @endforeach
                        </div>   
                    </div>
               </div> 
               <div class="col-9">
                   <div class="row">
                        <form method="POST" action="/" class="search-form col-12">
                            {{ csrf_field() }}
                            <label>Searching For</label>
                            <div class="form-group">
                                <div class="dropdown">
                                   <a class="btn btn-journal dropdown-toggle" href="#">Journals</a> 
                                </div>
                                <div class="search-input">
                                    <img src="{{asset('site/images/icons/article.png')}}" class="article-icon">
                                    <input type="text" name="search_text" placeholder="Search for articles">
                                </div>
                                <button type="submit" class="btn search-btn">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12 slider">
                            <div class="main-titles">
                                <h4>Popular Journals</h4>
                                <a href="#" class="see-all">See All</a>
                                <hr>
                            </div>
                            <div class="owl-theme owl-carousel" id="index-slider">
                                @foreach($popularJournals as $popularJournal)
                                <div class="item"><img src="{{asset('site/images/png/5BF72573-1252-4891-95B3-5E8F6A240C80.png')}}" alt="{{$popularJournal->title}}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 biomedical">
                            <div class="main-titles">
                                <h4>Popular Articles</h4>
                                <a href="/explore" class="see-all">See All</a>
                                <hr>
                            </div>
                            
                            <div class="row">
                            @foreach ($popularArticles as $popularArticle)
                            <div class="col-4 category-articles"> 
                                <div class="article-content">
                                    <p class="article-category">
                                        @if($popularArticle->journal)
                                        <span>{{$popularArticle->journal->title}} JOURNAL</span>
                                        @endif
                                    </p>
                                    <p class="article-date">
                                        <span>{{date("F j, Y", strtotime($popularArticle->published_at))}}</span>
                                    </p>
                                    <h5 class="article-title">
                                            {{$popularArticle->title}}
                                    </h5>
                                    <p class="article-author">
                                        <span class="author-name">by {{$popularArticle->user->name}}</span>
                                        <span class="line"></span>
                                    </p>
                                    <p class="article-excerpt">
                                            {!!$popularArticle->intro!!}
                                    </p>
                                    <p class="article-link">
                                        <a href="/article/{{$popularArticle->id}}">
                                            <span>See Abstract </span>
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                        </a>
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
@endsection