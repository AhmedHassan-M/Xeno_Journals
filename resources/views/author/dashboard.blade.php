@extends('layouts.master_user')

@section('content')
    
    <!--START EXPLORE PAGE-->
    <div class="author-dashboard-page">
    
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
                            <span>My Dashboard</span>
                        </div>
                        <h2>My Dashboard</h2>
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
                                    <a class="nav-link" id="id-all_submitted-tab"
                                    data-toggle="pill" href="#id-all_submitted"
                                    role="tab" aria-controls="id-all_submitted" aria-selected="true">
                                        <span>All Submitted Articles</span>
                                    </a>
                                    <a class="nav-link" id="id-published-tab"
                                    data-toggle="pill" href="#id-published"
                                    role="tab" aria-controls="id-published" aria-selected="true">
                                        <span>Published Articles</span>
                                    </a>
                                    <a class="nav-link" id="id-rejected-tab"
                                    data-toggle="pill" href="#id-rejected"
                                    role="tab" aria-controls="id-rejected" aria-selected="true">
                                        <span>Rejected Articles</span>
                                    </a>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-content">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade" id="id-all_submitted" role="tabpanel" aria-labelledby="id-all_submitted-tab">
                                            <h6 class="title">All Submitted Articles</h6>
                                            <div class="content">
                                                <div class="col-12">
                                                    <div class="row articles-container">
                                                        @foreach ($articles as $article)
                                                        <div class="col-4 article-container">
                                                            <div class="article-content">
                                                                <div class="article-options">
                                                                    <button type="button" class="article-options-btn">
                                                                        <img src="{{asset('site/images/icons/article-options.png')}}" alt="...">
                                                                    </button>
                                                                    <div class="article-dropdown d-none">
                                                                        @if($article->status < 2 || $article->status == 5)
                                                                        <a class="article-options-link" href="/author/edit-article/{{$article->id}}">
                                                                            Edit Article
                                                                        </a>
                                                                        <a class="article-options-link" href="/delete-article/{{$article->id}}">
                                                                            Delete Article
                                                                        </a>
                                                                        @elseif($article->status >= 2)
                                                                        <a class="article-options-link disabled" title="Editing is disabled now.">
                                                                            Edit Article
                                                                        </a>
                                                                        <a class="article-options-link disabled" title="Deleting is disabled now.">
                                                                            Delete Article
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @if($article->journal_id != 0)
                                                                <p class="article-category">
                                                                    <span>{{$article->journal->title}} JOURNAL</span>
                                                                </p>
                                                                @endif
                                                                <p class="article-date">
                                                                    <span>{{date("F j, Y", strtotime($article->published_at))}}</span>
                                                                </p>
                                                                <h6 class="article-title">
                                                                    {{$article->title}}
                                                                </h6>
                                                                <p class="article-author">
                                                                    <span class="author-name">by {{$article->user->name}}</span>
                                                                    <span class="line"></span>
                                                                </p>
                                                                <ul class="article-status list-unstyled">
                                                                    @if($article->status == 0)
                                                                    <li class="status-item">
                                                                    @elseif($article->status > 0)
                                                                    <li class="status-item passed">
                                                                    @else
                                                                    <li class="status-item disabled">
                                                                    @endif
                                                                        <span class="time">{{timeago($article->created_at)}}</span>
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Submitted</span>
                                                                    </li>
                                                                    @if($article->status == 1)
                                                                    <li class="status-item yellow">
                                                                    @elseif($article->status > 1)
                                                                    <li class="status-item yellow passed">
                                                                    @else
                                                                    <li class="status-item yellow disabled">
                                                                    @endif
                                                                        @if(!empty($article->revisioned_at))
                                                                        <span class="time">{{timeago($article->revisioned_at)}}</span>
                                                                        @else
                                                                        <!-- <span class="time"></span> -->
                                                                        @endif
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Revision</span>
                                                                    </li>
                                                                    @if($article->status == 5)
                                                                    <li class="status-item red">
                                                                        <span class="time">{{timeago($article->published_at)}}</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Rejected</span>
                                                                    </li>
                                                                    @endif
                                                                    @if($article->status != 5)
                                                                    @if($article->status == 2 || $article->status == 3 || $article->status == 3.5)
                                                                    <li class="status-item green">
                                                                    @elseif($article->status > 3)
                                                                    <li class="status-item green passed">
                                                                    @else
                                                                    <li class="status-item green disabled">
                                                                    @endif
                                                                    
                                                                        @if(!empty($article->assigned_at))
                                                                        <span class="time">{{timeago($article->assigned_at)}}</span>
                                                                        @else
                                                                        <!-- <span class="time"></span> -->
                                                                        @endif
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Approved</span>
                                                                    </li>
                                                                    
                                                                    
                                                                    @if($article->status == 4)
                                                                    <li class="status-item green">
                                                                    @else
                                                                    <li class="status-item green disabled">
                                                                    @endif
                                                                        @if(!empty($article->published_at))
                                                                        <span class="time">{{timeago($article->published_at)}}</span>
                                                                        @endif
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Published</span>
                                                                    </li>
                                                                    @endif
                                                                </ul>
                                                                <p class="article-view-link">
                                                                    <a href="/article/{{$article->id}}" class="btn btn-secondary">
                                                                        View your Article
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="id-published" role="tabpanel" aria-labelledby="id-published-tab">
                                            <h6 class="title">Published Articles</h6>
                                            <div class="content">
                                                <div class="col-12">
                                                    <div class="row articles-container">
                                                        @foreach ($publishedArticles as $publishedArticle)
                                                        <div class="col-4 article-container">
                                                            <div class="article-content">
                                                                <p class="article-category">
                                                                    @if($article->journal)
                                                                    <span>{{$publishedArticle->journal->title}} JOURNAL</span>
                                                                    @endif
                                                                    
                                                                </p>
                                                                <p class="article-date">
                                                                    <span>{{date("F j, Y", strtotime($publishedArticle->published_at))}}</span>
                                                                </p>
                                                                <h6 class="article-title">
                                                                        {{$publishedArticle->title}}
                                                                </h6>
                                                                <p class="article-author">
                                                                    <span class="author-name">by {{$publishedArticle->user->name}}</span>
                                                                    <span class="line"></span>
                                                                </p>
                                                                <ul class="article-status list-unstyled">
                                                                    <li class="status-item passed">
                                                                        <span class="time">{{timeago($publishedArticle->created_at)}}</span>
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Submitted</span>
                                                                    </li>
                                                                    <li class="status-item yellow passed">
                                                                        @if(!empty($publishedArticle->revisioned_at))
                                                                        <span class="time">{{timeago($publishedArticle->revisioned_at)}}</span>
                                                                        @else
                                                                        <span class="time"></span>
                                                                        @endif
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Revision</span>
                                                                    </li>
                                                                    <li class="status-item green passed">
                                                                        @if(!empty($publishedArticle->assigned_at))
                                                                        <span class="time">{{timeago($publishedArticle->assigned_at)}}</span>
                                                                        @else
                                                                        <span class="time"></span>
                                                                        @endif
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Approved</span>
                                                                    </li>
                                                                    <li class="status-item green">
                                                                        @if(!empty($publishedArticle->published_at))
                                                                        <span class="time">{{timeago($publishedArticle->published_at)}}</span>
                                                                        @else
                                                                        <span class="time"></span>
                                                                        @endif
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Published</span>
                                                                    </li>
                                                                </ul>
                                                                <p class="article-view-link">
                                                                    <a href="/article/{{$article->id}}" class="btn btn-secondary">
                                                                        View your Article
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="id-rejected" role="tabpanel" aria-labelledby="id-rejected-tab">
                                            <h6 class="title">Rejected Articles</h6>
                                            <div class="content">
                                                <div class="col-12">
                                                    <div class="row articles-container">
                                                        @foreach ($rejectedArticles as $rejectedArticle)
                                                        <div class="col-4 article-container">
                                                            <div class="article-content">
                                                                <div class="article-options">
                                                                    <button type="button" class="article-options-btn">
                                                                        <img src="{{asset('site/images/icons/article-options.png')}}" alt="...">
                                                                    </button>
                                                                    <div class="article-dropdown d-none">
                                                                        <a class="article-options-link" href="/author/edit-article/{{$rejectedArticle->id}}">
                                                                            Edit Article
                                                                        </a>
                                                                        <a class="article-options-link" href="/delete-article/{{$rejectedArticle->id}}">
                                                                            Delete Article
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <p class="article-category">
                                                                    @if($rejectedArticle->journal_id != 0)
                                                                    <span>{{$rejectedArticle->journal->title}} JOURNAL</span>
                                                                    @endif
                                                                    
                                                                </p>
                                                                <p class="article-date">
                                                                    <span>{{date("F j, Y", strtotime($rejectedArticle->published_at))}}</span>
                                                                </p>
                                                                <h6 class="article-title">
                                                                        {{$rejectedArticle->title}}
                                                                </h6>
                                                                <p class="article-author">
                                                                    <span class="author-name">by {{$rejectedArticle->user->name}}</span>
                                                                    <span class="line"></span>
                                                                </p>
                                                                <ul class="article-status list-unstyled">
                                                                    <li class="status-item passed">
                                                                        <span class="time">{{timeago($rejectedArticle->created_at)}}</span>
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Submitted</span>
                                                                    </li>
                                                                    <li class="status-item yellow passed">
                                                                        <span class="time">{{timeago($rejectedArticle->revisioned_at)}}</span>
                                                                        <span class="joining-line">|</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Revision</span>
                                                                    </li>
                                                                    <li class="status-item red">
                                                                        <span class="time">{{timeago($rejectedArticle->published_at)}}</span>
                                                                        <span class="circle-container">
                                                                            <span class="circle"></span>
                                                                        </span>
                                                                        <span class="status-name">Rejected</span>
                                                                    </li>
                                                                </ul>
                                                                <p class="article-view-link">
                                                                    <a href="/article/{{$article->id}}" class="btn btn-secondary">
                                                                        View your Article
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