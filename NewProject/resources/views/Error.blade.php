@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="{{ route('login.store') }}" method="POST">
@csrf
    <div class="container">
        <div class="formlogin">
            <div class="formlogin-title">
                <h3>Something Error !!</h3>
                <a href="/login">Back to login</a>
            </div>
        </div>
    </div>
</form>
@endsection