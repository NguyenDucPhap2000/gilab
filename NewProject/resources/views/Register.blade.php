@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <div class="container-register">
        <div class="results">
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
        <div class="formregister">
            <div class="container-title">
                <h1>Register</h1>
            </div>
            <div class="formregister-row">
                <div class="formregister-6rows">
                    <p>Name: </p>
                    <input name="name" type="text" value="{{ old('name') }}">
                </div>

                <div class="alert-danger">
                    {{ $errors->first('name') }}
                </div>

                <div class="formregister-6rows">
                    <p>Date of birth: </p>
                    <input name="dateofbirth" type="date" style="width: 256px">
                </div>

                <div class="alert-danger">
                    {{ $errors->first('dateofbirth') }}
                </div>

                <div class="formregister-6rows">
                    <p>Account: </p>
                    <input name="account" type="text" value="{{ old('account') }}">
                </div>

                <div class="alert-danger">
                    {{ $errors->first('account') }}
                </div>

                <div class="formregister-6rows">
                    <p>Password: </p>
                    <input name="password" type="password">
                </div>

                <div class="alert-danger">
                    {{ $errors->first('password') }}
                </div>

                <div class="formregister-6rows">
                    <p>Re-Password: </p>
                    <input name="RePassword" type="password">
                </div>

                <div class="alert-danger">
                    {{ $errors->first('RePassword') }}
                </div>

                <div class="formregister-6rows">
                    <p>Email: </p>
                    <input name="email" type="text" value="{{ old('email') }}">
                </div>

                <div class="alert-danger">
                    {{ $errors->first('email') }}
                </div>
            </div>
            <div class="formregister-row4">
                <button>Register</button>
            </div>
            <div class="backtologin">
                <a href="\login"><h5>I ready have account</h5></a>
            </div>
        </div>
    </div>
</form>
@endsection