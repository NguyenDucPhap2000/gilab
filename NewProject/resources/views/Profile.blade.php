@extends('layouts.FirstProject')
@section('head')
@section('content')
<div class="profile-task">
    <h3>Hello {{ Session('username') }}</h3>
    <a href="/logout">Log Out</a>
</div>
@endsection 