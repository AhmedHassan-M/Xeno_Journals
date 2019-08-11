<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Journal;

class journalsController extends Controller
{
    public function createJournal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'journal_name' => 'required|unique:journals,title',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('failure' , 'Journal '.$request->journal_name.' was already created');
        }else{
            $name = $request->journal_name;
            $volumes = $request->volumes_count;
            $description = $request->journal_description;

            $journal = new Journal;
            $journal->title = $name;
            $journal->volumes = $volumes;
            $journal->description = $description;
            
            if($journal->save()){
                return redirect()->back()->with('success' , 'Journal '.$journal->title.' has been created successfully');
            }else{
                return redirect()->back()->with('failure' , 'Internal server error');
            }
        }

    }

    public function allJournals()
    {
        $journals = Journal::with('article.user')->latest()->get();

        return view('admin.manage_journals.all_journals')->withJournals($journals);
    }

    public function deleteJournal(Request $request)
    {
        if ($request->apply == 'Delete') {
            for ($i=0; $i < count($request->changed) ; $i++) { 
                $journal = Journal::find($request->changed[$i]['id']);
                $journal->delete();

                foreach($journal->article as $article)
                {
                    $article->delete();
                }
            }
            return response()->json('success');
        }
        
        
        // $journal = Journal::find($id);
        // $journal->delete();
        // return response()->json($request->all());
    }

    public function updateJournal(Request $request)
    {
        $name = $request->journal_name;
        $volumes = $request->volumes_count;
        $description = $request->desc;
        $id = $request->id;

        $validator = Journal::where('id' , '!=' , $id)->where('title' , $name)->get();

        if(count($validator) == 0){
            $journal = Journal::find($id);
            $journal->title = $name;
            $journal->volumes = $volumes;
            $journal->description = $description;
            
            if($journal->save()){
                return response()->json('success');
            }else{
                return response()->json('Internal server error');
            }
        }else{
            return response()->json('Journal name already exists');
        }
        

    }

    public function exploreJournals() {
        return view('site.explore_journals');
    }
}
