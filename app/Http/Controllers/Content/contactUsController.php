<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Contactus;
use App\Subscribe;
use App\Contactuscontent;
use App\User;
use App\Notification;

class contactUsController extends Controller
{
    public function requestContactUs(Request $request)
    {
        $affiliation = $request->affiliation;
        $details = $request->details;
        $email = $request->emailcontact;
        $name = $request->namecontact;
        $subject = $request->subject;

        if(empty($affiliation) || empty($email) || empty($name)){
            return response()->json('required');
        }else{
            $contact = new Contactus;
            $contact->affiliation = $affiliation;
            $contact->subject = $subject;
            $contact->name = $name;
            $contact->email = $email;
            $contact->details = $details;
            $contact->save();

            $admins = User::where('privileges' , 'A')->get();

            foreach($admins as $admin){
                $notification = new Notification;
                $notification->text = 'New contact us request';
                $notification->url = '/admin/contact_form';
                $notification->seen = 0;
                $notification->type = 'contact';
                $notification->user_id = $admin->id;
                $notification->save();
            }

            return response()->json('success');
        }
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscribe_email' => 'required|unique:subscribes,email',
        ]);

        $email = $request->subscribe_email;

        if(!$validator->fails()){
            $subscribe = new Subscribe;
            $subscribe->email = $email;
            $subscribe->save();
        }

        return response()->json('success');
    }

    public function editContactUsContent() 
    {
        $contactUsContent = Contactuscontent::find(1);
        if(empty($contactUsContent)){
            $contactUsContent = (object) ['title' => '' , 'content' => '' , 'location' => '' , 'email' => ''];
        }
        return view('admin.manage_contentPages.contactUsPage')->withContactUsContent($contactUsContent);
    }

    public function updateContactUsContent(Request $request)
    {
        $title = $request->title;
        $content = $request->editordata;
        $location = $request->location;
        $email = $request->email;

        $contactUsContent = Contactuscontent::find(1);

        if(empty($contactUsContent)){
            $contactUsContent = new Contactuscontent;
        }

        $contactUsContent->title = $title;
        $contactUsContent->content = $content;
        $contactUsContent->location = $location;
        $contactUsContent->email = $email;

        try{
            $contactUsContent->save();
            return redirect()->back()->with('success' , 'Contact us page content is updated successfully');
        }catch(Exception $e){
            return redirect()->back()->with('failure' , 'Something went wrong');
        }

    }

    public function allContactUs() 
    {
        $allContactUs = Contactus::latest()->get();
        return view('admin.manage_contactUsForm.contactUsForm')->withAllContactUs($allContactUs);
    }

    public function deleteContact(Request $request)
    {
        if ($request->apply == 'Delete') {
            for ($i = 0 ; $i < count($request->changed) ; $i++) { 
                $contact = Contactus::find($request->changed[$i]['id']);
                $contact->delete();
            }
            return response()->json('success');
        }
    }

    // Site 

    public function contactUs() 
    {
        $contactUsContent = Contactuscontent::find(1);
        if(empty($contactUsContent)){
            $contactUsContent = (object) ['title' => '' , 'content' => '' , 'location' => '' , 'email' => ''];
        }
        return view('site.contactUs')->withContactUsContent($contactUsContent);
    }
}
