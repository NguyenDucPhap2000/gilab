@extends('layouts.FirstProject')
@section('head')
@section('content')
<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <section class="vh-1000" style="background-color: #eee; height: auto; width: 100%">
        <div class="results">
            @if (Session::get('success-register'))
                <div class="alert alert-success">
                    {{ Session::get('success-register') }}
                </div>
            @endif
            @if (Session::get('fail-register'))
                <div class="alert alert-danger">
                    {{ Session::get('fail-register') }}
                </div>
            @endif
        </div>
        <div class="container h-100" style="width: 1110px; height: auto; padding:100px 0">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5" style="padding: 0">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
      
                      <form class="mx-1 mx-md-4">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name="name" type="text" id="form3Example1c" class="form-control" value="{{ old('name') }}" />
                            <div class="alert-danger">{{ $errors->first('name') }}</div>
                            <label class="form-label" for="form3Example1c">Your Name</label>
                          </div>
                        </div>
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input name="dateofbirth" type="date" id="form3Example3c" class="form-control" />
                              <div class="alert-danger">{{ $errors->first('dateofbirth') }}</div>
                              <label class="form-label" for="form3Example3c">Date of birth</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name="email" value="{{ old('email') }}" type="email" id="form3Example3c" class="form-control" />
                            <div class="alert-danger">{{ $errors->first('email') }}</div>
                            <label class="form-label" for="form3Example3c">Your Email</label>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input name="account" value="{{ old('account') }}" type="text" id="form3Example3c" class="form-control" />
                                <div class="alert-danger">{{ $errors->first('account') }}</div>
                              <label class="form-label" for="form3Example3c">Account</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name="password" type="password" id="form3Example4c" class="form-control" />
                            <div class="alert-danger">{{ $errors->first('password') }}</div>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name="RePassword" type="password" id="form3Example4cd" class="form-control" />
                            <div class="alert-danger">{{ $errors->first('RePassword') }}</div>
                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                          </div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>
      
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</form>
@endsection