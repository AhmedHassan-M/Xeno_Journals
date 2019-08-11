<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;
use App\Author;
use App\Article;
use App\Journal;
use App\Activity;
use App\Notification;

class articleController extends Controller
{
    public function publishArticle(Request $request)
    {
        $title = $request->publish_title;
        $type = $request->articleType;
        $refrence = $request->Reference;
        $abstract = $request->abstract;
        $keywords = $request->keywords;
        $additionalInfo = $request->additionalInfo;
        $ethics = $request->ethicsCommunity;
        $affiliation = $request->publish_affiliation;
        $corresponding = $request->publish_corresponding;
        $degree = $request->publish_degree;
        $first_name = $request->publish_firstname;
        $last_name = $request->publish_lastname;
        $orcid = $request->publish_orcid;
        $financialDisclosure = $request->financialDisclosure;
        $intro = $request->intro;
        $authorName = $request->publish_addAuthorName;
        $authorTitle = $request->publish_addAuthorTitle;
        $authorAffiliation = $request->publish_addAuthorAffiliation;

        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $user->affiliation = $affiliation;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->degree = $degree;
            $user->ORCID_number = $orcid;
            $user->privileges = 'U';
            $user->save();

            $article = new Article;
            $article->title = $title;
            $article->type = $type;
            $article->corresponding_author = $corresponding;
            $article->abstract = $abstract;
            $article->keywords = $keywords;
            $article->intro = $intro;
            $article->additional_info = $additionalInfo;
            $article->reference = $refrence;
            $article->financial_disclosure = $financialDisclosure;
            $article->ethics_community = $ethics;
            $article->status = 0;
            $article->author_id = $user->id;
            $article->journal_id = 0;

            $wordFile = $this->uploadFile($request , 'wordFile');
            $figure = $this->uploadFile($request , 'figures' , 'image');
            $excel = $this->uploadFile($request , 'excelSheet');
            $authorConflict = $this->uploadFile($request , 'authorConflict');
            $financeDisclosureFile = $this->uploadFile($request , 'financial');

            if(!empty($wordFile)){
                $article->word_file = $wordFile;
            }

            if(!empty($figure)){
                $article->figures = $figure;
            }

            if(!empty($excel)){
                $article->excel_sheet = $excel;
            }

            if(!empty($authorConflict)){
                $article->author_conflict = $authorConflict;
            }

            if(!empty($financeDisclosureFile)){
                $article->financial_disclosure_file = $financeDisclosureFile;
            }

            $article->save();

            for($i = 0 ; $i < count($authorName) ; $i++){
                $author = new Author;
                $author->name = $authorName[$i];
                $author->title = $authorTitle[$i];
                $author->affiliation = $authorAffiliation[$i];
                $author->article_id = $article->id;
                $author->save();
            }

            $admins = User::where('privileges' , 'A')->get();

            foreach($admins as $admin){
                $notification = new Notification;
                $notification->text = 'New article publish request';
                $notification->url = '/admin/articles/requests';
                $notification->seen = 0;
                $notification->type = 'success';
                $notification->user_id = $admin->id;
                $notification->save();
            }
            
            return response()->json('success');
        }else{
            //redirect to login page
            return response()->json('unauthorized');
        }
    }

    public function updateArticle(Request $request , $id)
    {
        $title = $request->publish_title;
        $type = $request->articleType;
        $refrence = $request->Reference;
        $abstract = $request->abstract;
        $keywords = $request->keywords;
        $additionalInfo = $request->additionalInfo;
        $ethics = $request->ethicsCommunity;
        $affiliation = $request->publish_affiliation;
        $corresponding = $request->publish_corresponding;
        $degree = $request->publish_degree;
        $first_name = $request->publish_firstname;
        $last_name = $request->publish_lastname;
        $orcid = $request->publish_orcid;
        $financialDisclosure = $request->financialDisclosure;
        $intro = $request->intro;
        $authorName = $request->publish_addAuthorName;
        $authorTitle = $request->publish_addAuthorTitle;
        $authorAffiliation = $request->publish_addAuthorAffiliation;

        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $user->affiliation = $affiliation;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->degree = $degree;
            $user->ORCID_number = $orcid;
            $user->privileges = 'U';
            $user->save();

            $article = Article::find($id);

            $article->title = $title;
            $article->type = $type;
            $article->corresponding_author = $corresponding;
            $article->abstract = $abstract;
            $article->keywords = $keywords;
            $article->intro = $intro;
            $article->additional_info = $additionalInfo;
            $article->reference = $refrence;
            $article->financial_disclosure = $financialDisclosure;
            $article->ethics_community = $ethics;
            $article->status = 0;
            $article->author_id = $user->id;
            $article->journal_id = 0;
            $article->assigned_at = NULL;
            $article->revisioned_at = NULL;
            $article->published_at = NULL;

            $wordFile = $this->uploadFile($request , 'wordFile');
            $figure = $this->uploadFile($request , 'figures' , 'image');
            $excel = $this->uploadFile($request , 'excelSheet');
            $authorConflict = $this->uploadFile($request , 'authorConflict');
            $financeDisclosureFile = $this->uploadFile($request , 'financial');

            if(!empty($wordFile)){
                $article->word_file = $wordFile;
            }

            if(!empty($figure)){
                $article->figures = $figure;
            }

            if(!empty($excel)){
                $article->excel_sheet = $excel;
            }

            if(!empty($authorConflict)){
                $article->author_conflict = $authorConflict;
            }

            if(!empty($financeDisclosureFile)){
                $article->financial_disclosure_file = $financeDisclosureFile;
            }

            $article->save();

            foreach($article->author as $author){
                $author->delete();
            }

            for($i = 0 ; $i < count($authorName) ; $i++){
                $author = new Author;
                $author->name = $authorName[$i];
                $author->title = $authorTitle[$i];
                $author->affiliation = $authorAffiliation[$i];
                $author->article_id = $article->id;
                $author->save();
            }

            $admins = User::where('privileges' , 'A')->get();

            foreach($admins as $admin){
                $notification = new Notification;
                $notification->text = 'Updated article publish request';
                $notification->url = '/admin/articles/requests';
                $notification->seen = 0;
                $notification->type = 'success';
                $notification->user_id = $admin->id;
                $notification->save();
            }

            return response()->json('success');
        }else{
            //redirect to login page
            return response()->json('unauthorized');
        }
    }

    public function allAuthors() 
    {
        $allAuthors = User::where('privileges' , 'U')->latest()->get();
        return view('admin.manage_authors.authors')->withAllAuthors($allAuthors);
    }

    public function deleteAuthor(Request $request)
    {
        if ($request->apply == 'Delete') {
            for ($i=0; $i < count($request->changed) ; $i++) { 
                $author = User::find($request->changed[$i]['id']);
                $author->delete();

                foreach($author->article as $article){
                    $article->delete();

                    foreach($article->author as $author){
                        $author->delete();
                    }

                    foreach($article->activity as $activity){
                        $activity->delete();
                    }
                }

                foreach($author->activity as $activity){
                    $activity->delete();
                }
            }
            return response()->json('success');
        }
    }

    public function articleRequests() {
        $articles = Article::where('status' , '<=' , 1)->with('author')->latest()->get();
        $entries = User::where('privileges' , 'D')->get();
        $journals = Journal::all();
        return view('admin.manage_articles.article_requests')->withArticles($articles)->withEntries($entries)->withJournals($journals);
    }

    public function articleAssigned()
    {
        $articles = Article::where('status' , '>=' , 2)->where('status' , '<' , 4)->with('author')->latest()->get();
        $entries = User::where('privileges' , 'D')->get();
        $journals = Journal::all();
        return view('admin.manage_articles.assigned_articles')->withArticles($articles)->withEntries($entries)->withJournals($journals);
    }

    public function deleteArticle(Request $request)
    {
        if ($request->apply == 'Delete') {
            for ($i=0; $i < count($request->changed) ; $i++) { 
                $article = Article::find($request->changed[$i]['id']);
                $article->delete();

                foreach($article->author as $author){
                    $author->delete();
                }

                foreach($article->activity as $activity){
                    $activity->delete();
                }

                $notification = new Notification;
                $notification->text = $article->title.' article has been deleted';
                $notification->url = '/author/dashboard';
                $notification->seen = 0;
                $notification->type = 'warning';
                $notification->user_id = $article->author_id;
                $notification->save();
                
            }
            return response()->json('success');
        }
    }

    public function deleteAuthorArticle($id)
    {
        $article = Article::find($id);

        if(Auth::user()->privileges == 'U'){
            if($article->status >= 2 && $article->status < 5){
                return redirect('/author/dashboard');
            }else{
                $article->delete();

                foreach($article->author as $author){
                    $author->delete();
                }

                foreach($article->activity as $activity){
                    $activity->delete();
                }

                return redirect()->back()->with('success' , 'Article deleted successfully');
            }
        }elseif(Auth::user()->privileges == 'A'){
            $article->delete();

            foreach($article->author as $author){
                $author->delete();
            }

            foreach($article->activity as $activity){
                $activity->delete();
            }

            return redirect()->back()->with('success' , 'Article deleted successfully');
        }else{
            return redirect('/#unauthorized');
        }
        
        
    }

    public function approveArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assign_to_dataEntry' => 'required',
            'assign_to_journal' => 'required',
            'assign_to_vol' => 'required',
            'article_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json('required');
        }else{
            $dataEntry = $request->assign_to_dataEntry;
            $journal = json_decode($request->assign_to_journal);
            $volume = $request->assign_to_vol;
            $article_id = $request->article_id;

            $article = Article::find($article_id);
            $article->data_entry = $dataEntry;
            $article->journal_id = $journal->id;
            $article->volume = $volume;
            $article->status = 2;
            $article->assigned_at = new \DateTime();
            $article->save();

            $notification = new Notification;
            $notification->text = $article->title.' article has been approved';
            $notification->url = '/author/dashboard';
            $notification->seen = 0;
            $notification->type = 'success';
            $notification->user_id = $article->author_id;
            $notification->save();

            $notification = new Notification;
            $notification->text = 'New article assigned to you';
            $notification->url = '/data_entry/new_articles';
            $notification->seen = 0;
            $notification->type = 'success';
            $notification->user_id = $article->data_entry;
            $notification->save();

            return response()->json('success');
        }
        
    }

    public function rejectArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rejection_reasion' => 'required',
            'article_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json('required');
        }else{
            $id = $request->article_id;
            $reasons = $request->rejection_reasion;

            $article = Article::find($id);
            $article->status = 5;
            $article->published_at = new \DateTime();
            $article->rejection_reasons = $reasons;
            $article->save();

            $notification = new Notification;
            $notification->text = $article->title.' article has been rejected';
            $notification->url = '/author/dashboard';
            $notification->seen = 0;
            $notification->type = 'warning';
            $notification->user_id = $article->author_id;
            $notification->save();

            return response()->json('success');
        }
    }

    public function articleRejectedSuccessfully()
    {
        return redirect('/admin/articles/rejected')->with('success' , 'Article rejected successfully');
    }

    public function articleRejected()
    {
        $articles = Article::where('status' , 5)->with('author')->latest()->get();
        $entries = User::where('privileges' , 'D')->get();
        $journals = Journal::all();
        return view('admin.manage_articles.rejected_articles')->withArticles($articles)->withEntries($entries)->withJournals($journals);
    }

    public function newAssignedArticles()
    {
        $articles = Article::where('status' , 2)->where('data_entry' , Auth::user()->id)->with('author')->orderBy('updated_at' , 'desc')->get();
        return view('dataEntry.new_articles')->withArticles($articles);
    }

    public function articlePublished()
    {
        $articles = Article::where('status' , 4)->with('author')->latest()->get();
        $entries = User::where('privileges' , 'D')->get();
        $journals = Journal::all();
        return view('admin.manage_articles.published_articles')->withArticles($articles)->withEntries($entries)->withJournals($journals);
    }

    public function saveArticle(Request $request)
    {
        $type = $request->articleType;
        $refrence = $request->Reference;
        $abstract = $request->abstract;
        $keywords = $request->keywords;
        $additionalInfo = $request->additionalInfo;
        $ethics = $request->ethicsCommunity;
        $affiliation = $request->publish_affiliation;
        $corresponding = $request->publish_corresponding;
        $degree = $request->publish_degree;
        $first_name = $request->publish_firstname;
        $last_name = $request->publish_lastname;
        $orcid = $request->publish_orcid;
        $financialDisclosure = $request->financialDisclosure;
        $intro = $request->intro;
        $article_id = $request->article_id;

        if(Auth::check()){
            $article = Article::find($article_id);
            $article->type = $type;
            $article->corresponding_author = $corresponding;
            $article->abstract = $abstract;
            $article->keywords = $keywords;
            $article->intro = $intro;
            $article->additional_info = $additionalInfo;
            $article->reference = $refrence;
            $article->financial_disclosure = $financialDisclosure;
            $article->ethics_community = $ethics;
            $article->journal_id = 0;
            $article->status = 3;
            $article->published_at = new \DateTime();

            $wordFile = $this->updateFile($request , 'wordFile' , $article->word_file);
            $figure = $this->updateFile($request , 'figures' , $article->figures , 'image');
            $excel = $this->updateFile($request , 'excelSheet' , $article->excel_sheet);
            $authorConflict = $this->updateFile($request , 'authorConflict' , $article->author_conflict);
            $financeDisclosureFile = $this->updateFile($request , 'financial' , $article->financial_disclosure_file);

            if(!empty($wordFile)){
                $article->word_file = $wordFile;
            }

            if(!empty($figure)){
                $article->figures = $figure;
            }

            if(!empty($excel)){
                $article->excel_sheet = $excel;
            }

            if(!empty($authorConflict)){
                $article->author_conflict = $authorConflict;
            }

            if(!empty($financeDisclosureFile)){
                $article->financial_disclosure_file = $financeDisclosureFile;
            }

            $article->save();

            for($i = 0 ; $i < count($article->author) ; $i++){
                $authorNameKey = 'publish_addAuthorName'.$i;
                $authorTitleKey = 'publish_addAuthorTitle'.$i;
                $authorAffilKey = 'publish_addAuthorAffiliation'.$i;

                $authorName = $request->$authorNameKey;
                $authorTitle = $request->$authorTitleKey;
                $authorAffiliation = $request->$authorAffilKey;

                $author = $article->author;
                $author[$i]->name = $authorName;
                $author[$i]->title = $authorTitle;
                $author[$i]->affiliation = $authorAffiliation;
                $author[$i]->save();
            }

            return redirect('/data_entry/InProgress_articles')->with('success' , 'Article is in progress you can go & publish it');
        }else{
            //redirect to login page
            return redirect('/');
        }
    }

    public function startRevision($id)
    {
        $article = article::find($id);
        
        // In-progress
        $article->status = 1;
        $article->revisioned_at = new \DateTime();
        if($article->save()){
            $notification = new Notification;
            $notification->text = 'Revision has been started on your '.$article->title.' article';
            $notification->url = '/author/dashboard';
            $notification->seen = 0;
            $notification->type = 'success';
            $notification->user_id = $article->author_id;
            $notification->save();

            return response()->json('updated');
        }
    }

    public function inProgressArticles()
    {
        $articles = Article::where('status' , 3)->where('data_entry' , Auth::user()->id)->with('author')->orderBy('updated_at' , 'desc')->get();
        return view('dataEntry.in_progress_articles')->withArticles($articles);
    }

    public function sendToPublish($id)
    {
        $article = article::find($id);
        // Finished
        $article->status = 3.5;
        $article->rejection_reasons = NULL;
        $article->published_at = new \DateTime();
        if($article->save()){
            // author notification
            $notification = new Notification;
            $notification->text = $article->title.' article has been Sent to publish successfully';
            $notification->url = '/author/dashboard';
            $notification->seen = 0;
            $notification->type = 'success';
            $notification->user_id = $article->author_id;
            $notification->save();

            // admin notification
            $admins = User::where('privileges' , 'A')->get();

            foreach($admins as $admin){
                $notification = new Notification;
                $notification->text = $article->title.' article has been Sent to publish successfully';
                $notification->url = '/admin/articles/published';
                $notification->seen = 0;
                $notification->type = 'success';
                $notification->user_id = $admin->id;
                $notification->save();
            }

            return response()->json('updated');
        }
    }

    public function publish($id)
    {
        $article = article::find($id);
        // Finished
        $article->status = 4;
        $article->published_at = new \DateTime();
        if($article->save()){
            // author notification
            $notification = new Notification;
            $notification->text = $article->title.' article has been published successfully';
            $notification->url = '/author/dashboard';
            $notification->seen = 0;
            $notification->type = 'success';
            $notification->user_id = $article->author_id;
            $notification->save();

            // admin notification
            $admins = User::where('privileges' , 'A')->get();

            foreach($admins as $admin){
                $notification = new Notification;
                $notification->text = $article->title.' article has been published successfully';
                $notification->url = '/admin/articles/published';
                $notification->seen = 0;
                $notification->type = 'success';
                $notification->user_id = $admin->id;
                $notification->save();
            }

            return response()->json('success');
        }
    }

    public function sentToAdminSuccessfully()
    {
        return redirect('/data_entry/finished_articles')->with('success' , 'Article sent to admin successfully');
    }

    public function articleToDataEntry(Request $request)
    {
        $id = $request->article_id;
        $reason = $request->backToDataEntry_reasion;

        $article = Article::find($id);
        $article->rejection_reasons = $reason;
        $article->status = 2;
        $article->save();

        $notification = new Notification;
        $notification->text = 'article '.$article->title.' was refused by Admin';
        $notification->url = '/data_entry/new_articles';
        $notification->seen = 0;
        $notification->type = 'warning';
        $notification->user_id = $article->data_entry;
        $notification->save();

        return redirect()->back()->with('success' , 'Article sent to data entry successfully');
    }

    public function finishedArticles()
    {
        $articles = Article::where('status' , 3.5)->where('data_entry' , Auth::user()->id)->with('author')->orderBy('updated_at' , 'desc')->get();
        return view('dataEntry.finished_articles')->withArticles($articles);
    }

    public function viewArticle($id) {
        $article = Article::find($id);

        if(Auth::check()){
            if(Auth::user()->id == $article->author_id){
                $article->visit = $article->visit + 1;
                $article->save();

                $existing = Activity::where('user_id' , Auth::user()->id)->where('article_id' , $article->id)->first();

                if(empty($existing)){
                    $activity = new Activity;
                    $activity->user_id = Auth::user()->id;
                    $activity->article_id = $article->id;
                    $activity->save();
                }else{
                    $existing->created_at = new \DateTime();
                    $existing->save();
                }


                $keyword = $article->keywords; 
                $keywords = explode (" ", $keyword);  
                return view('site.view_article')->withArticle($article)->withKeywords($keywords);
            }else{
                if($article->status == 4){
                    $article->visit = $article->visit + 1;
                    $article->save();

                    if(Auth::check()){
                        $existing = Activity::where('user_id' , Auth::user()->id)->where('article_id' , $article->id)->first();

                        if(empty($existing)){
                            $activity = new Activity;
                            $activity->user_id = Auth::user()->id;
                            $activity->article_id = $article->id;
                            $activity->save();
                        }else{
                            $existing->created_at = new \DateTime();
                            $existing->save();
                        }
                        
                    }


                    $keyword = $article->keywords; 
                    $keywords = explode (" ", $keyword);  
                    return view('site.view_article')->withArticle($article)->withKeywords($keywords);
                }else{
                    return redirect('/');
                }
            }
        }else{
            if($article->status == 4){
                $article->visit = $article->visit + 1;
                $article->save();

                $keyword = $article->keywords; 
                $keywords = explode (" ", $keyword);  
                return view('site.view_article')->withArticle($article)->withKeywords($keywords);
            }else{
                return redirect('/');
            }
        }
    }

    public function searchForArticles(Request $request)
    {
        $text = $request->search_text;

        if($request->search_category){
            $journalId = $request->search_category;

            $journal = Journal::find($journalId);
            $articles = $journal->article()->where('status' , 4)->where('title' , 'like' , '%'.$text.'%')->get();
            $articleTypes = $journal->article()->where('status' , 4)->where('title' , 'like' , '%'.$text.'%')->distinct()->get(['type']);

            return view('site.search')->withText($text)->withJournal($journal)->withArticles($articles)->withArticleTypes($articleTypes);
        }else{
            $articles = Article::where('status' , 4)->where('title' , 'like' , '%'.$text.'%')->select('journal_id')->get();
            
            $journalsIds = array();

            foreach($articles as $i => $article){
                $journalsIds[$i] = $article->journal_id;
            }

            $uniqueJournalsIds = array_unique($journalsIds);

            $journals = Journal::whereIn('id' , $uniqueJournalsIds)->get();
            $articleTypes = Article::where('status' , 4)->where('title' , 'like' , '%'.$text.'%')->distinct()->get(['type']);
            return view('site.search')->withText($text)->withJournals($journals)->withArticles($articles)->withArticleTypes($articleTypes);
        }
    }

    public function authorDash() {
        $articles = Article::where('author_id' , Auth::user()->id)->latest()->get();
        $publishedArticles = Article::where('author_id' , Auth::user()->id)->where('status' , 4)->latest()->get();
        $rejectedArticles = Article::where('author_id' , Auth::user()->id)->where('status' , 5)->latest()->get();
        return view('author.dashboard')->withArticles($articles)->withPublishedArticles($publishedArticles)->withRejectedArticles($rejectedArticles);
    }

    public function authorEditArticle($id)
    {
        $article = Article::find($id);

        if(Auth::user()->privileges == 'U'){
            if($article->status >= 2 && $article->status < 5){
                return redirect('/author/dashboard');
            }
        }

        return view('author.edit_article')->withArticle($article);
    }

    public function userIndex()
    {
        $user = User::find(Auth::user()->id);
        $activities = $user->activity()->latest()->limit(2)->get();

        $popularArticles = Article::where('status' , 4)->orderBy('visit' , 'desc')->get();
        $popularJournals = Journal::join('articles', 'journals.id', '=', 'articles.journal_id')->orderBy('articles.visit', 'desc')->select('journals.*')->get();

        return view('author.index')->withActivities($activities)->withPopularArticles($popularArticles)->withPopularJournals($popularJournals);
    }
}
