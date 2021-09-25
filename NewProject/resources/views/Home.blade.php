@extends('layouts.FirstProject')
@section('head')
@section('content')
<div class="container-profile">
    <div class="results">
        @if (Session::get('home-fail'))
             <div class="alert alert-danger">
                 {{ Session::get('home-fail') }}
             </div>
        @endif
        @if (Session::get('home-success'))
             <div class="alert alert-success">
                 {{ Session::get('home-success') }}
             </div>
        @endif
</div>
    <div class="container-profile-hello">
        <h3>Hello {{ Session('username') }}</h3>
    </div>
    <main class="container-profile-main">
        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">        
            @csrf
            <div class="container-profile-postBlog">
                <div class="container-profile-img-name">
                    <div class="container-profile-smImg">
                        <img src="{{ asset('img/phap.jpg') }}" alt="user-image">
                    </div>
                    <div class="container-profile-yourname">
                        <label>{{ Session('username') }}</label>
                    </div>
                </div>
                <div class="postBlog">
                    <div class="manageBlog-title">
                        <input name="title" placeholder="Enter your title" type="text" value="{{ old('title') }}">
                    </div>
                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                    <div class="manageBlog-img">
                        <input name="image" type="file" value="{{ old('image') }}">
                    </div>
                    <div class="manageBlog-blogcontent">
                        <textarea name="content" placeholder="Enter your content" >{{ old('content') }}</textarea>
                    </div>
                    <div class="alert-danger">{{ $errors->first('content') }}</div>
                    <div class="manageBlog-button">
                        <button type="submit">Post Blog</button>
                    </div>
                </div>
            </div>
        </form>    
        @isset($data)
            @foreach ($data as $value )
            <div class="container-profile-user"> 
                <div class="container-profile-img-name">
                    <div class="container-profile-smImg">
                        <img src="{{ asset('img/phap.jpg') }}" alt="user-image">
                    </div>
                    <div class="container-profile-yourname">
                        <label>{{ $value->UserName }}</label>
                    </div>
                    @if (Session('id')==$value->userID)
                     <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Post Status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ url('article/' .$value->id. '/changestatus/' .$status=1) }}">Public</a>
                            <a class="dropdown-item" href="{{ url('article/' .$value->id. '/changestatus/' .$status=2) }}">Private</a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="container-profile-title">
                    <h3>
                        {{ $value->title }}
                    </h3>
                </div>
                <div class="container-profile-blog">
                    @isset($value->image)
                    <div class="container-profile-img">
                        <img src="{{ asset('storage/img/'.$value->image) }}" alt="">
                    </div>
                    @endisset
                    <p>
                        {{ $value->content }}
                    </p>
                </div>
            </div>
            @endforeach
        @endisset
    </main>
</div>
<div class="profile-task">
</div>
@endsection 