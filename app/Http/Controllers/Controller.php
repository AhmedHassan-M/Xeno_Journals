<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Preview;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($request , $key , $type = 'file')
    {
        //image upload 
        if($request->hasFile($key)){
                    // Get file name with the extension
                $fileNameWithExt = $request->file($key)->getClientOriginalName();
                    // Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    // Get just Ext
                $extension = $request->file($key)->getClientOriginalExtension();
                    // File name to store
                $fileNameToStore =  $fileName.'_'.time().'.'.$extension;
                    // $path = $request->file('slider1')->storeAs('image', $fileNameToStore);
                $file = $request->$key;
                if($type == 'file'){
                    $file->move('uploads/files', $fileNameToStore );
                }elseif($type == 'image'){
                    $file->move('uploads/images', $fileNameToStore );
                }

                return $fileNameToStore;
        }
    }

    public function updateFile($request , $key , $currentFile , $type = 'file')
    {
        //image upload 
        if($request->hasFile($key)){

                if($currentFile != NULL){
                    if($type == 'file'){
                        // Delete File
                        if(is_file('uploads/files/'.$currentFile)) {
                            unlink('uploads/files/'.$currentFile);
                        }
                    }elseif($type == 'image'){
                        // Delete image
                        if(is_file('uploads/images/'.$currentFile)) {
                            unlink('uploads/images/'.$currentFile);
                        }
                    }
                }

                    // Get file name with the extension
                $fileNameWithExt = $request->file($key)->getClientOriginalName();
                    // Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    // Get just Ext
                $extension = $request->file($key)->getClientOriginalExtension();
                    // File name to store
                $fileNameToStore =  $fileName.'_'.time().'.'.$extension;
                    // $path = $request->file('slider1')->storeAs('image', $fileNameToStore);
                $file = $request->$key;

                if($type == 'file'){
                    $file->move('uploads/files', $fileNameToStore );
                }elseif($type == 'image'){
                    $file->move('uploads/images', $fileNameToStore );
                }

                return $fileNameToStore;
        }
    }

    public function downloadFile($file_name){
    	//$file_path = public_path('/files/'.$file_name);
    	if($file_name != NULL){
    		return response()->download('/uploads/files/'.$file_name);
    	}else{
    		return redirect('/404');
    	}
    }

    public function imageUsed($image)
    {
        $used = Preview::where('image' , $image)->get();

        if(count($used) >= 2){
            return true;
        }else{
            return false;
        }
    }
}
