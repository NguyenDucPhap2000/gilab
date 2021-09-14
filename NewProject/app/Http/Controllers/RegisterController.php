<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\NewRequest;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;

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
        $user = new User();
        $user->name = $request->name;
        $user->dateofbirth = $request->dateofbirth;
        $user->account = $request->account;
        $user->password = Hash::make($request->password);
        // $user->password = md5($request->password);
        // $user->password = bcsqrt($request->password);
        $user->email = $request->email;
        $query = $user->save();
       
        if($query){
            return back()->with('success','You have been successfully registered');
        }else{
            return back()->with('fail','Somethings went wrong');
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
