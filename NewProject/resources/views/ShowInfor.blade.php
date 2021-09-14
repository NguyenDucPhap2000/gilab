@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="/updateinfor" method="POST">
    @csrf
    <div class="results">
        @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
<div class="container-information">

<div class="information">
    <div class="information-rows">
        <label class="information-infor" for="account">Account:</label>
        <input name="account" type="text" value="{{ $data['account'] }}" disabled>
    </div>
    <div class="information-rows">
        <label class="information-infor" for="password">Password</label>
        <input name="password" type="password" value="{{ $data['password'] }}">
    </div>
    <div class="alert-danger">
        {{ $errors->first('password') }}
    </div>
    <div class="information-rows">
        <label class="information-infor" for="RePassword">Re-Password</label>
        <input name="RePassword" type="password" value="{{ $data['password'] }}">
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
</form>
@endsection