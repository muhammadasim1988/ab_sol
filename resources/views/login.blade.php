@extends('layouts.master')

@section('content')
<style>
    .login-form {
        width: 340px;
        margin: 50px auto;
          font-size: 15px;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
    </style>
<div class="login-form">
    @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif
    <form method="POST" id="user-login-form" action="{{ route('process.user.login') }}" novalidate="novalidate" enctype="">
        @csrf
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" id="user_login" class="btn btn-primary btn-block">Log in</button>

        </div>
    </form>
    <p class="text-center"><a href="{{ route('site.user.register') }}">Create an Account</a></p>
</div>

@endsection
