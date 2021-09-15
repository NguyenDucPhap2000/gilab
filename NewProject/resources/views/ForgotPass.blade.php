@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="" method="">
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
                <h3>Find Your Account</h3>
            </div>
            <div class="formforgotten infor">
                Please enter your email address to search for your account.
            </div>
            <div class="formlogin-row1-2" style="padding: 40px">
                <div class="formlogin-row2">
                    <input name="account" placeholder="Enter Your Email" type="text" style="width: 360px;
                    height: 44px;
                    border-radius: 6px;">
                </div>
            </div>
            <div class="formlogin-row3">
                <button class="formlogin-row3-btn" type="submit" ><a href="/login">Cancel</a></button>
                <button class="formlogin-row3-btn" type="submit" >Search</button>
            </div>
        </div>
    </div>
</form>
@endsection