@extends(((Auth::user()) ? 'layouts.master_user' : 'layouts.master_site'))

@section('content')

<div class="container-fluid hero-section">
    <div class="row">
        <div class="container">
            <div class="row hero-top">
                <div class="hero-cta text-center">
                    <h1>{{$homePageContent->title}}</h1>
                    <p>Download. Share. Publish.<span> your articles</span></p>
                    <form method="POST" class="search-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="search-input">
                                <select name="search_category" class="selectpicker">
                                    @foreach($exploreJournals as $exploreJournal)
                                    <option value="{{$exploreJournal->id}}">{{$exploreJournal->title}}</option>
                                    @endforeach
                                </select>
                                <img src="{{asset('site/images/icons/article.png')}}" class="article-icon">
                                <input type="text" name="search_text" placeholder="Search for articles">
                                <img src="{{asset('site/images/icons/search-gray.png')}}" class="search-icon">
                            </div>
                            <button type="submit" class="btn search-btn">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row hero-about">
                <div class="col-12">
                    <div class="row head">
                        <h3>About {{$homePageContent->title}}</h3>
                        <p>
                                {!!$homePageContent->content!!} 
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12 d-flex justify-content-start">
                            <div class="block">
                                <div class="icon">
                                    <img src="{{asset('site/images/icons/search-blue.png')}}">
                                </div>
                                <h6>Search / Select Journals</h6>
                                <p>
                                    Find Article you want from Journals or using search
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 d-flex justify-content-center">
                            <div class="block">
                                <div class="icon">
                                    <img src="{{asset('site/images/icons/download-blue.png')}}">
                                </div>
                                <h6>Read & Download & Share</h6>
                                <p>
                                    You can read, share and download articles you want
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 d-flex justify-content-end">
                            <div class="block">
                                <div class="icon">
                                    <img src="{{asset('site/images/icons/publish-blue.png')}}">
                                </div>
                                <h6>Publish your Article</h6>
                                <p>
                                    Become an author and write, publish your articles
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="/explore" class="browse-all">
                                <i class="fas fa-long-arrow-alt-right"></i>
                                <span>Browse all categories</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="landing-popular-section container-fluid">
    <div class="row">
        <div class="container">
            <div class="row popular-journals-section">
                <div class="col-12">
                    <div class="row head">
                        <h3>Xeno Journals</h3>
                    </div>
                </div>
                @if(count($journalsPreview) > 0)
                <div class="col-12">
                    <div class="row categories">
                        <div class="col-md-3 col-xs-12 category-column">
                            <div class="category-item">
                                <a href="#">
                                    <img src="{{asset('uploads/images/'.$journalsPreview[0]->image)}}">
                                    <span class="overlay"></span>
                                    <span class="journal_title">{{$journalsPreview[0]->details}}</span>
                                </a>
                            </div>
                            @if($journalsPreview[1]->image)
                            <div class="category-item">
                                <a href="#">
                                    <img src="{{asset('uploads/images/'.$journalsPreview[1]->image)}}">
                                    <span class="overlay"></span>
                                    <span class="journal_title">{{$journalsPreview[1]->details}}</span>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4 col-xs-12 category-column">
                            @if($journalsPreview[2]->image)
                            <div class="category-item">
                                <a href="#">
                                    <img src="{{asset('uploads/images/'.$journalsPreview[2]->image)}}">
                                    <span class="overlay"></span>
                                    <span class="journal_title">{{$journalsPreview[2]->details}}</span>
                                </a>
                            </div>
                            @endif
                            @if($journalsPreview[3]->image)
                            <div class="category-item">
                                <a href="#">
                                    <img src="{{asset('uploads/images/'.$journalsPreview[3]->image)}}">
                                    <span class="overlay"></span>
                                    <span class="journal_title">{{$journalsPreview[3]->details}}</span>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-5 col-xs-12 category-column">
                            @if($journalsPreview[4]->image)
                            <div class="category-item">
                                <a href="#" class="long">
                                    <img src="{{asset('uploads/images/'.$journalsPreview[4]->image)}}">
                                    <span class="overlay"></span>
                                    <span class="journal_title">{{$journalsPreview[4]->details}}</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="row popular-articles-section">
            <div class="col-12">
                    <div class="row head">
                        <h3>Popular Articles</h3>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row articles">
                        @foreach ($popularArticles as $popularArticle)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 article">
                            <div class="article-content">
                                <p class="article-category">
                                    <span>{{$popularArticle->journal->title}} JOURNAL</span>
                                </p>
                                <p class="article-date">
                                    <span>{{date("F j, Y", strtotime($popularArticle->published_at))}}</span>
                                </p>
                                <h6 class="article-title">
                                    {{$popularArticle->title}}
                                </h6>
                                <p class="article-author">
                                    <span class="author-name">by {{$popularArticle->user->name}}</span>
                                    <span class="line"></span>
                                </p>
                                <div class="article-excerpt">
                                    {!!$popularArticle->intro!!}
                                </div>
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

@endsection

@section('scripts')

@endsection