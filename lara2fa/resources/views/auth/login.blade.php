@extends('layouts.app')

@section('content')
 <div class="main-wrapper">


        <div class="container">

            <!-- Account Logo -->
            <div class="account-logo">
                <a href="index.html"><img src="assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
            </div>
            <!-- /Account Logo -->

            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Login</h3>
                    <p class="account-subtitle">Access to our dashboard</p>

                  <div class="form-group">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                         <div class="account-footer">
                    <p>Don't have an account yet? <a href="{{route('register')}}">Register</a></p>
                </div>
                    </form>
                </div>
                <hr>
              <div align="center">
                <h2>OR</h2>
                  <b>login with</b> <br>  <a href="redirect/github">
                    <img src="{{Config::get('app.url')}}/public/g.svg" width="50px"/>
                  </a>
                <div>

            </div>
        </div>
    </div>
</div>
@endsection
