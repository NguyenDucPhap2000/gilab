@extends('layouts.FirstProject')
@section('head')
@section('content')
<div class="results">
        @if (Session::get('article-fail'))
             <div class="alert alert-danger">
                 {{ Session::get('article-fail') }}
             </div>
        @endif
        @if (Session::get('article-success'))
             <div class="alert alert-success">
                 {{ Session::get('article-success') }}
             </div>
        @endif
</div>
<div id="container" class="container-manageBlog"> 
    <div class="container-manageBlog-hello">
        <h3>Hello {{ Session('username') }}</h3>
    </div>
    {{-- <div id="modal-container" class="container-manageBlog-edit-form">
        <div class="edit-modal-form">
            <div class="title-form">
                <h3>Edit Form</h3>
            </div>
            <div class="edit-title">
                <input name="editTitle" type="text">
            </div>
            <div class="edit-content">
                <textarea name="eidtContent" type="text"></textarea>
            </div>
            <div class="edit-image" accept="image/png, image/jpeg">
                <input name="editImage" type="file">
            </div>
            <div class="button-edit-form">
                <button id="close">Close</button>
                <button>Send</button>
            </div>
        </div>
    </div> --}}
    <main id="main" class="container-manageBlog-main">
        <div  class="container-manageBlog-right">
            <div class="manageBLog-right-table">
                <table class="table">
                    <thead>
                      <tr class="table-info">
                        <th class="table-one" scope="col">Title</th>
                        <th class="table-one" scope="col">Content</th>
                        <th class="table-small" scope="col">Image</th>
                        <th class="table-small" scope="col">Post Status</th>
                        <th class="table-small" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @isset($data)
                        @foreach ($data as $value )

                        <tr class="table-tr">
                            <td>
                                <textarea class="table-texarea" disabled >{{ $value->title }}</textarea>
                            </td>
                            <td>
                                <textarea class="table-texarea" disabled >{{ $value->content }}</textarea>
                            </td>
                            @if (isset($value->image))
                                <td>
                                    <div class="img-hover"> 
                                        <div>
                                            <a href="#">{{ $value->image }}</a>
                                            <img src="{{ asset('storage/img/'.$value->image) }}" alt="">
                                        </div>
                                    </div>
                                </td>        
                            @else
                                <td>
                                    <div class="img-hover"> 
                                        <div>
                                            <a href="#">{{ $value->image }}</a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                            <td>
                                @if ($value->displayed==1)
                                    <p>Public</p>
                                @else
                                    <p>Private</p>
                                @endif    
                            </td>    
                                <td class="td-button">
                                    <a style="color: white" class="btn btn-primary" 
                                    data-toggle="modal" data-target="#exampleModalCenter{{ $value->id }}">Edit</a>
                                    <a style="color: white" type="button" class="btn btn-danger" 
                                    data-toggle="modal" data-target="#exampleModal{{ $value->id }}"> Delete </a>
                                </td>
                                @include('EditForm')
                                @include('Delete')
                            </tr>
                        @endforeach    
                    @endisset
                    </tbody>
                  </table>
                </div>
              <div class="paginate">
                {{ $data->links('vendor.pagination.custom') }}
                </div>
            </div>
        </main>
    </div>
{{-- <script>
    new Vue({
        el: "#container",
        data(){
            return{
                selected: true
            }
        },
        methods: {
            update: function(){
                console.log("update");
            }
        }
    });
    const open = document.getElementById('open');
    const close = document.getElementById('close');
    const container = document.getElementById('modal-container');
    const main = document.getElementById('main');

    open.addEventListener('click',() => {
        container.classList.add('show');
        main.classList.add('main-hide');
    });

    close.addEventListener('click', () => {
        container.classList.remove('show');
        main.classList.remove('main-hide');
    });
</script> --}}
@endsection