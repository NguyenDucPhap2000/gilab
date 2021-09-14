@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="{{ route('login.store') }}" method="POST">
@csrf
    <div class="container">
        <div class="results">
            @if (Session::get('fail'))
                 <div class="alert alert-danger">
                     {{ Session::get('fail') }}
                 </div>
            @endif
         </div>
        <div class="formlogin">
            <div class="formlogin-title">
                <h1>Login</h1>
            </div>
            <div class="formlogin-row1-2">
                <div class="formlogin-row1">
                    <p>Account: </p>
                    <p>Password: </p>
                </div>
                <div class="formlogin-row2">
                    <input name="account" type="text">
                    <input name="password" type="password">
                </div>
            </div>
            <div class="formlogin-row3">
                <button class="formlogin-row3-btn" type="submit" >Login</button>
            </div>
            <div class="formlogin-row4">
                <span><input name="remember" type="checkbox" value="">Remember</span>
                <span><a href="/register">Register</a></span>
            </div>
            <div class="formlogin-row5">
                <a href="">Forgot Password ?</a>
            </div>
        </div>
    </div>
</form>
@endsection