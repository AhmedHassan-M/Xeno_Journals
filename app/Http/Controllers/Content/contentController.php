<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Download;
use App\Downloadcontent;
use App\Homepagecontent;
use App\Article;
use App\Preview;
use App\About;

class contentController extends Controller
{
    public function manageDownloads(Request $request) {
        $req = $request->req;
        

        if($req == 'content'){
            $RTEcontent = $request->content;

            $content = Downloadcontent::find(1);

            if(empty($content)){
                $content = new Downloadcontent;
            }

            $content->content = $RTEcontent;
            $content->save();
            return redirect()->back()->with('success1' , 'Page content is updated successfully');

        }elseif($req == 'new file'){
            $title = $request->title;
            $description = $request->description;
            
            $download = new Download;
            $download->title = $title;
            $download->description = $description;

            $file = $this->uploadFile($request , 'file');

            if(!empty($file)){
                $download->file = $file;
            }

            $download->save();
            return redirect()->back()->with('success2' , 'File '.$download->title.' uploaded successfully');
        }
    }

    public function allFiles() {
        $downloads = Download::latest()->get();
        $content = Downloadcontent::find(1);
        if(empty($content)){
            $content = (object) ['content' => ''];
        }
        return view('admin.manage_downloads')->withDownloads($downloads)->withContent($content);
    }

    public function deleteDownloads($id)
    {
        $download = Download::find($id);
        $download->delete();

        return redirect()->back()->with('success2' , 'File '.$download->title.' is deleted successfully');
    }

    public function updateDownloads(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;

        $download = Download::find($id);
        $download->title = $title;
        $download->description = $description;

        $file = $this->updateFile($request , 'file' , $download->file);

        if(!empty($file)){
            $download->file = $file;
        }

        $download->save();
        return response()->json('success');
    }

    public function downloadCenter() {
        $downloads = Download::latest()->get();
        $content = Downloadcontent::find(1);
        if(empty($content)){
            $content = (object) ['content' => ''];
        }
        return view('site.downloads')->withDownloads($downloads)->withContent($content);
    }

    public function updateHomePageContent(Request $request)
    {
        $title = $request->title;
        $content = $request->editordata;

        $homePageContent = Homepagecontent::find(1);

        if(empty($homePageContent)){
            $homePageContent = new Homepagecontent;
        }

        $homePageContent->title = $title;
        $homePageContent->content = $content;
        $homePageContent->save();

        return redirect()->back()->with('success' , 'Home page content is updated successfully');
    }

    public function updateJournalPreview(Request $request)
    {
        $added = Preview::all();

        if(count($added) == 0){
            for($i = 1 ; $i <= 5 ; $i++){
                $imagesKey = 'journal_image'.$i;
                $detailsKey = 'journal_details'.$i;
                $details = $request->$detailsKey;
    
                $preview = new Preview;
                $preview->details = $details;
    
                $image = $this->uploadFile($request , $imagesKey , 'image');
                
                if(!empty($image)){
                    $preview->image = $image;
                }
    
                $preview->save();
            }
        }else{
            $details1 = $request->journal_details1;
            $details2 = $request->journal_details2;
            $details3 = $request->journal_details3;
            $details4 = $request->journal_details4;
            $details5 = $request->journal_details5;

            $added[0]->details = $details1;

            $delete = $this->imageUsed($added[0]->image);

            if($delete){
                $image1 = $this->uploadFile($request , 'journal_image1' , 'image');
            }else{
                $image1 = $this->updateFile($request , 'journal_image1' , $added[0]->image , 'image');
            }
            

            if(!empty($image1)){
                $added[0]->image = $image1;
            }
            $added[0]->save();

            $added[1]->details = $details2;
            $delete = $this->imageUsed($added[1]->image);

            if($delete){
                $image2 = $this->uploadFile($request , 'journal_image2' , 'image');
            }else{
                $image2 = $this->updateFile($request , 'journal_image2' , $added[1]->image , 'image');
            }

            if(!empty($image2)){
                $added[1]->image = $image2;
            }
            $added[1]->save();

            $added[2]->details = $details3;
            $delete = $this->imageUsed($added[2]->image);

            if($delete){
                $image3 = $this->uploadFile($request , 'journal_image3' , 'image');
            }else{
                $image3 = $this->updateFile($request , 'journal_image3' , $added[2]->image , 'image');                
            }

            if(!empty($image3)){
                $added[2]->image = $image3;
            }
            $added[2]->save();

            $added[3]->details = $details4;
            $delete = $this->imageUsed($added[3]->image);

            if($delete){
                $image4 = $this->uploadFile($request , 'journal_image4' , 'image');
            }else{
                $image4 = $this->updateFile($request , 'journal_image4' , $added[3]->image , 'image');
            }

            if(!empty($image4)){
                $added[3]->image = $image4;
            }
            $added[3]->save();

            $added[4]->details = $details5;
            $delete = $this->imageUsed($added[4]->image);

            if($delete){
                $image5 = $this->uploadFile($request , 'journal_image5' , 'image');
            }else{
                $image5 = $this->updateFile($request , 'journal_image5' , $added[4]->image , 'image');
            }

            if(!empty($image5)){
                $added[4]->image = $image5;
            }
            $added[4]->save();
        }

        return redirect()->back();
    }

    public function editHomePage() {
        $homePageContent = Homepagecontent::find(1);
        $journalsPreview = Preview::all();
        if(empty($homePageContent)){
            $homePageContent = (object) ['title' => '' , 'content' => ''];
        }
        return view('admin.manage_homePage.home_page')->withHomePageContent($homePageContent)->withJournalsPreview($journalsPreview);
    }

    public function homePage() {
        $homePageContent = Homepagecontent::find(1);
        $popularArticles = Article::where('status' , 4)->orderBy('visit' , 'desc')->get();
        $journalsPreview = Preview::all();
        if(empty($homePageContent)){
            $homePageContent = (object) ['title' => '' , 'content' => ''];
        }
        return view('site.index')->withHomePageContent($homePageContent)->withPopularArticles($popularArticles)->withJournalsPreview($journalsPreview);
    }

    public function manageAbout() {
        $abouts = About::all();
        return view('admin.manage_about.manage_about')->withAbouts($abouts);
    }

    public function updateAbout(Request $request)
    {
        $id = $request->page_id;

        for($i = $id ; $i > 0 ; $i--){
            $titleKey = 'title'.$i;
            $titleContent = 'content'.$i;

            $about = About::find($i);

            if($about){
                $about->title = $request->$titleKey;
                $about->paragraph = $request->$titleContent;
                $about->save();
            }
            
        }

        return redirect()->back();
    }

    public function AboutUs() {
        $abouts = About::all();
        return view('site.about')->withAbouts($abouts);
    }

    public function deleteAbout(Request $request)
    {
        $id = $request->id;

        $about = About::find($id);
        $about->delete();

        return response()->json('success');
    }

    public function addAboutUsContent(Request $request)
    {
        $title = $request->title;
        $content = $request->content;

        $about = new About;
        $about->title = $title;
        $about->paragraph = $content;
        $about->save();

        return response()->json('success');
    }
}
