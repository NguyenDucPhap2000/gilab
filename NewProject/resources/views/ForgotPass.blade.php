@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="/accountverify" method="Post">
@csrf
    <div class="container">
        <div class="results">
            @if (Session::get('fail-forget'))
                 <div class="alert alert-danger">
                     {{ Session::get('fail-forget') }}
                 </div>
            @endif
            @if (Session::get('success-forget'))
                 <div class="alert alert-success">
                     {{ Session::get('success-forget') }}
                 </div>
            @endif
         </div>
        <div class="formlogin">
            <div class="formlogin-title">
                <h3>Find Your Account</h3>
            </div>
            <div class="formlogin-row1-2" style="padding: 40px">
                <div class="formlogin-row2">
                    @if (Session::get('email'))
                    <div class="alert alert-success">
                        Your Email :
                        <input type="text" name="mail" 
                        value="{{ Session::get('email') }}" style="text-align: center" disabled>
                    </div>
                    @else
                        <input name="account" placeholder="Enter Your Account" type="text" style="width: 360px;
                        height: 44px;
                        border-radius: 6px;" value="{{ Session::get('account') }}">
                        <div class="alert-danger">
                            @error('account')
                                {{ $message }}
                            @enderror
                        </div>
                    @endif
                </div>
            </div>
            <div class="formlogin-row3">
                @if (Session::get('email'))
                <button class="formlogin-row3-btn" type="button" >
                    <a href="/login">Cancel</a>
                </button>

                <button class="formlogin-row3-btn" type="button" >
                    <a href="/sendcode">Send code</a>
                </button>

                @else
                <button class="formlogin-row3-btn" type="button" >
                    <a href="/login">Cancel</a>
                </button>

                <button class="formlogin-row3-btn" type="submit" >Search</button>
            </div>
            @endif
        </div>
    </div>
</form>
@endsection