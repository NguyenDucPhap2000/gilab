@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="/resetpassword" method="POST" class="formReset">
    <div class="results">
        @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
    </div>
    @csrf
    <div class="container-newpass">
        <div class="container-newpass-form">
            <div class="container-newpass-title">
                <label for="title">Reset your password</label>
            </div>
            @if( Session::get('changePassword') == '1')
                <div class="container-newpass-input">
                    <input placeholder="Enter your code" name="code" type="text">
                    <button class="container-newpass-sendButton" type="submit">Send</button>
                </div>
            @else
            <div class="container-newpass-input">
            <input name="newpassword" placeholder="Enter your new password" 
                 type="password">
            <input name="repeatpass" type="password" placeholder="Repeat your password">
            </div>
            <div class="container-newpass-button">
                <button type="submit">Reset password</button>
            </div>
            <div class="alert-danger" style="
                width: 80%;
                height: auto;
                margin: 3% auto;
                text-align: center">{{ Session::get('validate') }}</div>
            @endif
        </div>
    </div>
</form>
@endsection