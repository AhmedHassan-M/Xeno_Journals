<?php

namespace App\Http\Controllers\CustomAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;
use Socialite;
use App\User;

class AuthController extends Controller
{
    public function userSignup(Request $request)
    {
        $affiliation = $request->signup_affiliation;
        $password = $request->signup_confirmpassword;
        $email = $request->signup_email;
        $name = $request->signup_name;
        $fullName = explode(" ", $name);
        $firstName = $fullName[0];
        if(count($fullName) > 1){
            $lastName = $fullName[1];
        }

        $validator = Validator::make($request->all(), [
            'signup_email' => 'required|unique:users,email',
        ]);

        if($validator->fails()){
            return response()->json('used');
        }else{
            $user = new User;
            $user->name = $name;
            $user->first_name = $firstName;
            if(isset($lastName)){
                $user->last_name = $lastName;
            }
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->affiliation = $affiliation;
            $user->save();

            Auth::login($user);

            return response()->json('success');
        }
    }

    public function userLogin(Request $request)
    {
        $email = $request->login_email;
        $password = $request->login_password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
                
            // Authentication passed...
            return response()->json('success');
            
        }else{
            return response()->json('failure');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Forget password
    
    public function sendEmail(Request $request)
    {
        $v = Validator::make(request()->all(), [
            'forgot_email' => 'email|exists:users,email',
        ]);

        if ($v->fails()) {
            return response()->json('failure');
        }else{
            $code = rand(100000 , 1000000);

            $recoveryMail = $request->forgot_email;
            $user = User::where('email' , $recoveryMail)->first();
            $user->code = $code;
            $user->save();

            $to = $user->email;
            $subject = "Password Recovery";
            $txt = "Click the following link to reset your code: <a href='http://".$_SERVER["HTTP_HOST"]."/reset-password/".$user->email."/".$user->code."'>Reset password</a>";
            $from= 'From: http://'.$_SERVER["HTTP_HOST"];

            //mail($to,$subject,$txt,$from);

            return response()->json('success');
        }
    }

    public function resetPassword($email , $code)
    {
        $user = User::where('email' , $email)->first();
        if($user->code == $code){
            return view('admin.manage_login.forget2')->withEmail($email);
        }else{
            return redirect('/');
        }
    }

    public function confirmNewPassword(Request $request , $email , $code)
    {
        $password = $request->password;
        $confirmPassword = $request->password_confirmation;

        if($password == $confirmPassword){
            $user = User::where('email' , $email)->where('code' , $code)->first();
            $user->password = bcrypt($confirmPassword);
            $user->code = NULL;
            $user->save();

            Auth::login($user);

            if(Auth::user()->privileges == 'A'){
                return redirect('/admin/dashboard');
            }elseif(Auth::user()->privileges == 'D'){
                return redirect('/data_entry/dashboard');
            }else{
                return redirect('/');
            }

        }else{
            return redirect()->back()->with('failure' , 'Passwords are not the same');
        }
        
        return $request->all();
    }

    // login using linked in

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::with('linkedin')->user();
            $name = $user->name;
            $email = $user->email;
            $linkedin_id = $user->id;
            $avatar = $user->avatar;
            $password = rand(10000,100000);

            $v = Validator::make([$email] , ['exists:users,email']);
            
            if($v->fails()){
                $newUser = new User;
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->linkedin_id = $linkedin_id;
                $newUser->avatar = $avatar;
                $newUser->password = bcrypt($password);
                $newUser->save();

                Auth::login($newUser);
            }else{
                $existUser = User::where('email' , $email)->where('linkedin_id' , $linkedin_id)->first();
                Auth::login($existUser);
            }
            
            return redirect('/');
        } catch (Exception $e) {
            return redirect('/auth/linkedin');
        }
    }
    
    public function adminLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email , 'password' => $password , 'privileges' => 'A'])) {
                
            // Authentication passed...
            return Redirect::intended('/admin/dashboard');
            
        }else{
            return redirect()->back()->with('failure' , 'Email or Password is incorrect')->withInput();
        }
    }

    public function addEmail()
    {
        return view('admin.manage_login.forget1');
    }

    public function editDashboardProfile() {
        if(Auth::check()){
            if(Auth::user()->privileges == 'A'){
                return view('admin.manage_admin.settings');
            }elseif(Auth::user()->privileges == 'D'){
                return view('dataEntry.settings');
            }else{
                return redirect('/#unauthorized');
            }
        }else{
            return redirect('/#unauthorized');
        }
    }

    public function updateAdminProfile(Request $request)
    {
        $name = $request->userName;
        $email = $request->email;
        $password = $request->password;
        $confirmPass = $request->confirmPassword;

        $admin = User::find(Auth::user()->id);

        if(!empty($admin)){

            if($admin->privileges == 'A' || $admin->privileges == 'D'){
                
                    $admin->name = $name;
                    $admin->email = $email;
        
                    if(!empty($password)){
                        if($password == $confirmPass){
                            $admin->password = bcrypt($confirmPass);
                        }else{
                            return redirect()->back()->with('failure' , 'Passwords do not match each others');
                        }
                    }
        
                    $admin->save();
                
                
                return redirect()->back()->with('success' , 'profile data is updated successfully');
            }else{
                return redirect('/logout');
            }

        }else{
            return redirect('/#unauthorized');
        }
    }

    public function dataEntryLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email , 'password' => $password , 'privileges' => 'D'])) {
                
            // Authentication passed...
            return Redirect::intended('/data_entry/dashboard');
            
        }else{
            return redirect()->back()->with('failure' , 'Email or Password is incorrect')->withInput();
        }
    }

    public function updateProfileImg(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $image = $this->updateFile($request , 'user_img' , $user->image , 'image');

        if(!empty($image)){
            $user->image = $image;
        }

        $user->save();

        return redirect()->back()->with('imgSuccess' , 'Profile image updated successfully');
    }

    public function updateUserData(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $currentPass = $request->current_password;
        $newPass = $request->new_password;
        $confirmPass = $request->repeat_new_password;

        if(Auth::check()){

            $user = User::find(Auth::user()->id);
            $user->name = $name;
            $user->email = $email;

            if(!empty($newPass)){
                if(Auth::attempt(['email' => Auth::user()->email, 'password' => $currentPass])){
                    if($newPass == $confirmPass){
                        $user->password = bcrypt($confirmPass);
                    }else{
                        return redirect()->back()->with('failure' , 'Passwords are not the same');
                    }
                }else{
                    return redirect()->back()->with('currentPassFailure' , 'Current password is incorrect');
                }
            }
            
            $user->save();

            return redirect()->back()->with('success' , 'Profile data updated successfully');
        }

    }

    public function seen()
    {
        if(Auth::check())
        {
            $user = User::find(Auth::user()->id);

            $notifications = $user->notification;
            foreach($notifications as $notification){
                $notification->seen = 1;
                $notification->save();
            }

            return response()->json('success');
        }
    }

    public function checkPassword(Request $request)
    {
        $currentPass = $request->current_password;
        
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $currentPass])){
            return response()->json('same');
        }else{
            return response()->json('different');
        }
    }
}
