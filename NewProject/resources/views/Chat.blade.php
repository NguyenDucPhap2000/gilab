@extends('layouts.FirstProject')
@section('head')
@section('content')
<div class="container-profile-hello">
    <h3>Hello {{ Session('username') }}</h3>
</div>
<div id="app" class="container">
    <!-- Page header start -->
    <div class="page-title">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <h3 class="title">Chat Room</h3>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> </div>
        </div>
    </div>
    <!-- Page header end -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card m-0">

                    <!-- Row start -->
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3" style="margin: 0; padding: 0 1% 0 0">
                            <div class="users-container">
                                <div class="chat-search-box">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="users">
                                    <li  class="person" data-chat="person1">
                                        <div class="user">
                                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                            <span class="status busy"></span>
                                        </div>
                                         <p class="name-time">
                                            <span class="name"></span>
                                            <span class="time">15/02/2019</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9" style="background-color: white">
                            <div class="selected-user">
                                <span>To: <span class="name">Emily Russell</span></span>
                            </div>
                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll">
                                    <li v-for="value in allText" class="chat-left">
                                        <div class="chat-avatar">
                                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                            <div class="text-black">@{{ value.username }}</div>
                                        </div>
                                        <div class="alert alert-info"><h4>@{{ value.message }}</h4></div>
                                        <div class="chat-hour">{{ now() }} <span class="fa fa-check-circle"></span></div>
                                    </li>
                                    {{-- <li class="chat-right">
                                        <div class="chat-hour">08:56 <span class="fa fa-check-circle"></span></div>
                                        <div class="chat-text">Hi, Russell
                                            <br> I need more information about Developer Plan.</div>
                                        <div class="chat-avatar">
                                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                            <div class="chat-name">Sam</div>
                                        </div>
                                    </li> --}}
                                </ul>
                                <div class="form-group mt-3 mb-0">
                                        @csrf
                                    <input @keyup.enter="sentmessage" name="messages" v-model="messages" class="form-control" rows="3" placeholder="Type your message here..."></input>
                                    {{-- <input @click="sentmessage" type="submit"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->
</div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
   const app = new Vue({
        el: "#app",
        data: {
            messages: "",
            allText: [],
        },
        methods: {
            sentmessage: function(){
                axios.post('/sent',{messageSent: this.messages});
                this.messages="";
                // this.allText.push(this.messages);
            }
        },
    });
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9396c3be745143cf7f13', {
      cluster: 'ap1'
    });
    var channel = pusher.subscribe('my-chat');
    channel.bind('my-event', function(data) {
      app.allText.push(data);
    });
</script>
@endsection