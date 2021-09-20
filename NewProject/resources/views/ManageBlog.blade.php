@extends('layouts.FirstProject')
@section('head')
@section('content')
<div class="container-manageBlog">
    <div class="container-manageBlog-hello">
        <h3>Hello {{ Session('username') }}</h3>
    </div>
    <main class="container-manageBlog-main">
        
    </main>
</div>
@endsection