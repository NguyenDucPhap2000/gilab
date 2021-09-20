<?php

namespace App\Http\Controllers;

use App\Models\ForgottenPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\GetPassByEmail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgetPassController extends Controller
{
    public function index(){
        session()->forget('changePassword');
        session()->forget('fail');
        session()->forget('validate');
        return view('ForgotPass');
    }
    public function verifyAccount(Request $request){
        $request->validate([
                'account'=>'required|min:6'
        ]);
        try{
            if(DB::table('users')->where('account',$request->account)->exists()){
                $data =DB::table('users')
                ->where('account',$request->account)->pluck('email');
                $request->session()->put('emailgetpass',$data);
                $request->session()->put('getPasswordAccount',$request->account);
                return back()->with('email',$data)->with('account',$request->account);
            }else{
                return back()->with('fail-forget','Account not exist !');
            }
        }catch(Exception $e){
            return view('Error');
        }
   }
    public function sendToEmail(Request $request){
        if(!$request->session()->get('getPasswordAccount') && 
        !$request->session()->get('getPasswordAccount')){
            return \redirect('forgotten')->with('fail-forget','You must enter your account first');
        }
        $userID = DB::table('users')
        ->where('account',$request->session()->get('getPasswordAccount'))->pluck('id');
        $code = Str::random(6);
        $url = Str::random(60);
        $id = str_replace(array('[',']'),array('',''),$userID);
        $request->session()->put('UserId',$id);
            ForgottenPassword::create([
                'code' => $code,
                'userID' => $id,
                'url' => $url
            ]);
        // $updatePass = User::find($id);
        // $newPassGetDB = DB::table('forgotten_passwords')
        // ->where('id',$id)->pluck('newpass')->max('created_at'); 
        // $newPass = str_replace(array('[',']','"','"'),array('','','',''),$newPassGetDB);
        $request->session()->put('url',$url);
        $request->session()->put('code',$code);
        // $updatePass->password = Hash::make($newPass);
        // $updatePass->save();
        $emailsession = $request->session()->get('emailgetpass');
        $email = str_replace(array('[',']','"','"'),array('','','',''),$emailsession);
        Mail::to($email)->send(new GetPassByEmail ($code,$url));
        $request->session()->forget('emailgetpass');
        $request->session()->forget('getPasswordAccount');
        return back()->with('success-forget', 'You can check your email to get your code');
    }
    public function verifyCode(Request $request,$url){
        $urlDB = $request->session()->get('url');
        if($url===$urlDB){
            $request->session()->put('changePassword','1');
            return view('NewPassword');
        }else{
            return view('Login')->with('fail','Can not change your password');
        }
    }
    public function checkcodeReset(Request $request){
        $request->session()->forget('fail');
        $request->session()->forget('validate');
        $code = $request->code;
        if($code){
            $codeSession = $request->session()->get('code');
            if($codeSession===$code){
                $request->session()->put('changePassword','2');
                return view('NewPassword');
            }else{
                $request->session()->put('fail','Your code is not true');
                return view('NewPassword');
            }
        }
        try{
            $changePassword = $request->session()->get('changePassword');
            if($changePassword==2){
                if(strlen($request->newpassword) < 6 && strlen($request->repeatpass) < 6 ){
                    $request->session()->put('validate','Password must be 6-8 characters ');
                    return view('NewPassword');
                }else{
                    if(strcmp($request->newpassword,$request->repeatpass)===0){
                        $UserId = $request->session()->get('UserId');
                        $user = User::find($UserId);
                        $user->password = Hash::make($request->newpassword);
                        $user->save();
                        $request->session()->forget('UserId');
                        $request->session()->forget('changePassword');
                        $request->session()->forget('fail');
                        $request->session()->forget('validate');
                        $request->session()->forget('url');
                        return redirect()->route('login.index')->with('success-login','Your password has been changed');
                    }else{
                        $request->session()->put('validate','Your password is not matched');
                        return view('NewPassword');
                    }
                }
            }else{
                $request->session()->put('fail','Your code is not true');
                return view('NewPassword');
            }
        }catch(Exception $e){
            return view('Error');
        }
    }
}