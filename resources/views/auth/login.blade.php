@extends('_template_auth.layout')

@section('content')
<div class="my-auto page page-h">
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
        <div class="wd-md-200p login d-none d-md-block page-signin-style p-5 text-white" >
            <div class="my-auto authentication-pages">
                <div>
                    <img src="../assets/img/brand/logo-white.png" class=" m-0 mb-4" alt="logo">
                    <h5 class="mb-4">Login Web Fajar</h5>
                    <p class="mb-5"></p>
                </div>
            </div>
        </div>
        <div class="sign-up-body wd-md-500p">
            <div class="main-signin-header">
                <h2>Welcome back!</h2>
                <h4>Please sign in to continue</h4>
                <form action="{{ route('auth') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email</label><input class="form-control" placeholder="Enter your email" type="email"
                        value="{{ old('email') }}" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label> <input class="form-control" placeholder="Enter your password" type="password"
                         value="{{ old('password') }}" name="password">
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Sign In</button>
                    <div class="main-signin-footer mt-3 mg-t-5">
                        <p>Registrasi <a href="{{ route('register') }}">Buat Akun</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
</div>
@endsection
