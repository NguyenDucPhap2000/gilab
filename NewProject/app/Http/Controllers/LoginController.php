<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout(){
        if(session()->has('username')){
            session()->pull('username');
            session()->forget('username');
            session()->forget('id');
            return view('Login');
        }
    }
    public function checklogin(){
        return 'check login';
    }
    public function showdata($id){
        $data = User::find($id);
        return view('ShowInfor',['data'=>$data]);
    }
    public function updatedata(Request $request){
        $request->validate([
            'name'=>'min:6|max:30|required',
            'dateofbirth'=>'date',
            'password'=>[
            'required',
            'min:6',
            'max:30',
            'regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d).+$/'],
            'RePassword'=>'same:password|required|alpha_num',
            'email'=>'required|email:rfc,dns'
        ]);
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->dateofbirth = $request->dob;
        $data->password = Hash::make($request->password);
        $data->email = $request->email;
        $check = $data->save();
        // $check = DB::table('users')->where('id',$request->id)->update(['name'=>$request->name,
        // 'dateofbirth'=>$request->dob,
        // 'password'=>Hash::make($request->password),
        // 'email'=>$request->email]);
        // $data = User::find($request->id);
        if($check){
            return back()->with(['success'=>'Update success','data'=>$data]);
        }else{
            return back()->with(['fail'=>'Update fail','data'=>$data]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //    'account'=>'required|min:8|max:30',
        //    'password'=>'required|min:6|max:30' 
        // ]);
        $user = User::where('account','=',$request->account)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $checknull = DB::table('users')
                ->where('email_verified_at',null)
                ->where('account','=',$request->account)
                ->exists();
                if($checknull){
                    Auth::logout();
                    return \redirect(route('login.index'))->with('fail','You must verify first');
                }else{
                    $data = $request->input();
                    $request->session()->put('username',$data['account']);
                    $request->session()->put('id',$user['id']);
                    return view('Profile');
                }
            }else{
                return back()->with('fail','Login failed');
            }
        }else{
            return back()->with('fail','Login failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
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
