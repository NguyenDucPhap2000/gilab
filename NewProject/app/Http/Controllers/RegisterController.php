<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'min:6|max:30|required',
            'dateofbirth'=>'required|date',
            'account'=>'min:6|max:30|required',
            'password'=>[
            'required',
            'min:6',
            'max:30',
            'regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d).+$/'],
            'RePassword'=>'same:password|required|alpha_num',
            'email'=>'required|email:rfc,dns'
        ],[
            'password.required'=>'Must be 6-8 characters and at least one Uppercase Charater'
        ]);
        if(DB::table('users')->where('account',$request->account)->exists()){
            return back()->with('fail-register','Account has been exist');
        }else if(DB::table('users')->where('email',$request->email)->exists()){
            return back()->with('fail-register','Email has been exist');
        }
        $user = new User();
        $user->name = $request->name;
        $user->dateofbirth = $request->dateofbirth;
        $user->account = $request->account;
        $user->password = Hash::make($request->password);
        // $user->password = md5($request->password);
            // $user->password = bcsqrt($request->password);
        $user->email = $request->email;
        $query = $user->save();
        VerifyUser::create([
        'token' => Str::random(60),
        'user_id' => $user->id
        ]);
        Mail::to($user->email)->send(new VerifyEmail($user));
        if($query){
            return back()->with('success-register','Sign up success. You must verify to login');
        }else{
            return back()->with('fail-register','Somethings went wrong');
        }
    }

    public function verifyEmail($token){
        $verifiedUser = VerifyUser::where('token',$token)->first();
        if(isset($verifiedUser)){
            $user = $verifiedUser ->user;
            if(!$user->email_verified_at){
                $user->email_verified_at = Carbon::now();
                $user->save();
                return \redirect(route('login.index'))->with('success-login', 'Your email has been verified');
            }else{
                return \redirect()->back()-with('infor','Your email has already been verified');
            }
        }else{
            return \redirect(route('login.index'))->with('error','Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
