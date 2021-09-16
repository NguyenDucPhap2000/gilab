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
                return back()->with('fail','Account not exist !');
            }
        }catch(Exception $e){
            return view('Error');
        }
   }
    public function sendToEmail(Request $request){
        if(!$request->session()->get('getPasswordAccount') && 
        !$request->session()->get('getPasswordAccount')){
            return \redirect('forgotten')->with('fail','You must enter your account first');
        }
        $userID = DB::table('users')
        ->where('account',$request->session()->get('getPasswordAccount'))->pluck('id');
        $id = str_replace(array('[',']'),array('',''),$userID);
            ForgottenPassword::create([
                'newpass' => Str::random(6),
                'userID' => $id
            ]);
        $updatePass = User::find($id);
        $newPassGetDB = DB::table('forgotten_passwords')
        ->where('id',$id)->pluck('newpass'); 
        $newPass = str_replace(array('[',']','"','"'),array('','','',''),$newPassGetDB);
        $updatePass->password = Hash::make($newPass);
        $updatePass->save();
        $emailsession = $request->session()->get('emailgetpass');
        $email = str_replace(array('[',']','"','"'),array('','','',''),$emailsession);
        Mail::to($email)->send(new GetPassByEmail ($newPass));
        $request->session()->forget('getPasswordAccount');
        $request->session()->forget('emailgetpass');
        return back()->with('success', 'You can check your email to get your new password');
    }
}