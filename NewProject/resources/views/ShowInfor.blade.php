@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="/updateinfor" method="POST">
    @csrf
    <div class="results">
        @if (Session::get('fail-login'))
        <div class="alert alert-danger">
            {{ Session::get('fail-login') }}
        </div>
        @endif
        @if (Session::get('success-login'))
            <div class="alert alert-success">
                {{ Session::get('success-login') }}
            </div>
        @endif
    </div>
    <div class="container-profile-hello">
        <h3>Hello {{ Session('username') }}</h3>
    </div>
    <div class="cover-container-information">
    <div class="container-information">
    <div class="container-information-left">

    </div>
    <div class="container-information-right">
    <div class="information">
    <div class="information-rows-title">
        <h3><span>PERSONAL</span></h3>
    </div>
    <div class="information-rows">
        <label class="information-infor" for="account">Account:</label>
        <input name="account" type="text" value="{{ $data['account'] }}" disabled>
    </div>
    <div class="information-rows">
        <label class="information-infor" for="password">Password</label>
        @if (Session::get('change'))
            <input name="password" type="password" value="{{ $data['password'] }}">
        @else
            <input name="" type="password" value="{{ $data['password'] }}" disabled>
        @endif
            <a href="/change">Change</a>
    </div>
    <div class="alert-danger">
        {{ $errors->first('password') }}
    </div>
    <div class="information-rows">
        <label class="information-infor" for="RePassword">Re-Password</label>
        @if (Session::get('change'))
        <input name="RePassword" type="password" value="{{ $data['password'] }}">
        @else
        <input name="" type="password" value="{{ $data['password'] }}" disabled>
        @endif
    </div>
    <div class="alert-danger">
        {{ $errors->first('RePassword') }}
    </div>
    <div class="information-rows">
        <label class="information-infor" for="name">Name:</label>
        <input name="name" type="text" value="{{ $data['name'] }}">
    </div>
    <div class="alert-danger">
        {{ $errors->first('name') }}
    </div>
    <div class="information-rows">
        <label class="information-infor" for="email">Email:</label>
        <input name="email" type="text" value="{{ $data['email'] }}">
    </div>
    <div class="alert-danger">
        {{ $errors->first('email') }}
    </div>
    <div class="information-rows">
        <label class="information-infor" for="dob">Date of birth:</label>
        <input name="dob" type="date" value="{{ $data['dateofbirth'] }}">
    </div>
    <div class="alert-danger">
        {{ $errors->first('dateofbirth') }}
    </div>
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    <div class="information-button">
        <button type="submit">Save</button>
    </div>
</div>
</div>
</div>
</div>
</form>
@endsection