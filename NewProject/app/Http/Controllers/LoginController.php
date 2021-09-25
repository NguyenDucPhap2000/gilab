<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout()
    {
        if (session()->has('username')) {
            session()->forget('username');
            session()->forget('id');
            session()->forget('change');
            session()->forget('UserId');
            session()->forget('changePassword');
            // session()->forget('fail-login');
            session()->forget('validate');
            return view('Login');
        }
        return view('Login');
    }
    public function showdata($id, Request $request)
    {
        $var = $request->session()->get('id');
        if ($var) {
            $data = User::find($id);
            return view('ShowInfor', ['data' => $data]);
        } else {
            return view('Login');
        }
        return view('Login');
    }
    public function updatedata(Request $request)
    {
        $change = $request->session()->get('change');
        $data = User::find($request->id);
        $request->validate([
            'name' => 'min:6|max:30|required',
            'dateofbirth' => 'date',
            'email' => 'required|email:rfc,dns'
        ]);
        if ($change) {
            $request->validate([
                'password' => [
                    'required',
                    'min:6',
                    'max:30',
                    'regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d).+$/'
                ],
                'RePassword' => 'same:password|required|alpha_num',
            ]);
            $data->password = Hash::make($request->password);
        }
        $data->name = $request->name;
        $data->dateofbirth = $request->dob;
        $data->email = $request->email;
        $check = $data->save();
        $request->session()->put('username', $data['name']);
        // $check = DB::table('users')->where('id',$request->id)->update(['name'=>$request->name,
        // 'dateofbirth'=>$request->dob,
        // 'password'=>Hash::make($request->password),
        // 'email'=>$request->email]);
        // $data = User::find($request->id);
        if ($check) {
            session()->forget('change');
            return back()->with(['success-login' => 'Update success', 'data' => $data]);
        } else {
            return back()->with(['fail-login' => 'Update fail', 'data' => $data]);
        }
    }
    public function changePass(Request $request)
    {
        $request->session()->put('change', 'change');
        return back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session()->forget('UserId');
        session()->forget('changePassword');
        // session()->forget('fail-login');
        session()->forget('validate');
        $value = $request->session()->get('id');
        if ($value) {
            $data = article::get();
            return view('Home', ['data' => $data]);
        } else {
            return view('Login');
        }
        return view('Home');
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
        $request->validate([
            'account' => 'required|min:6|max:30',
            'password' => 'required|min:6|max:30'
        ]);
        $user = User::where('account', '=', $request->account)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $checknull = DB::table('users')
                    ->where('email_verified_at', null)
                    ->where('account', '=', $request->account)
                    ->exists();
                if ($checknull) {
                    Auth::logout();
                    return \redirect(route('login.index'))->with('fail-login', 'You must verify first');
                } else {
                    $request->session()->put('username', $user['name']);
                    $request->session()->put('id', $user['id']);
                    return \redirect(route('article.index'));
                }
            } else {
                return back()->with('fail-login', 'Login failed');
            }
        } else {
            return back()->with('fail-login', 'Login failed');
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
