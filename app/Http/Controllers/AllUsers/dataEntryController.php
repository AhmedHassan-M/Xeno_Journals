<?php

namespace App\Http\Controllers\AllUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class dataEntryController extends Controller
{
    public function addDataEntry(Request $request)
    {
        $name = $request->userName;
        $email = $request->email;
        $password = $request->password;
        $confirmPassword = $request->confirmPassword;

        $entry = User::where('privileges' , 'D')->where('email' , $email)->first();

        if(empty($entry)){
            $entry = new User;
            $entry->name = $name;
            $entry->email = $email;

            if(!empty($password)){
                if($password == $confirmPassword){
                    $entry->password = bcrypt($confirmPassword);
                }else{
                    return redirect()->back()->with('failure' , 'Passwords do not match each others')->withInput();
                }
            }

            $entry->privileges = 'D';
            $entry->save();

            return redirect()->back()->with('success' , 'Data entry '.$entry->name.' is added successfully');
        }else{
            return redirect()->back()->with('failure' , 'Email entered already exist')->withInput();
        }
    }

    public function allDataEntries() {
        $allDataEntries = User::where('privileges' , 'D')->latest()->get();
        return view('admin.manage_dataEntry.all_data_entry')->withAllDataEntries($allDataEntries);
    }

    public function deleteDataEntry(Request $request)
    {
        if ($request->apply == 'Delete') {
            for ($i = 0 ; $i < count($request->changed) ; $i++) { 
                $entry = User::find($request->changed[$i]['id']);
                $entry->delete();
            }
            return response()->json('success');
        }
    }
}
