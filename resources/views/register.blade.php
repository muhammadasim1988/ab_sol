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
    <form method="POST" id="user-login-form" action="{{ route('process.user.register') }}" novalidate="novalidate" enctype="">
        @csrf
        <h2 class="text-center">Register</h2>
        <div class="form-group">
            <input type="email" name="name" id="name" class="form-control" placeholder="Name" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="first_name" id="first_name" class="form-control" placeholder="First Name" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="address" id="address" class="form-control" placeholder="Address" required="required">
        </div>

        <div class="form-group">
            <input type="email" name="dob" id="dob" class="form-control" placeholder="Date of Birth mm/dd/yy" required="required">
        </div>

        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required="required">
        </div>
        <p>Interest</p>
        @if ($interestList)
            @foreach ($interestList as $interest)
                <div class="form-check">
                    <input class="form-check-input" name="interest[]" type="checkbox" value="{{ $interest->id }}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    {{ $interest->title }}
                    </label>
                </div>
            @endforeach
        @endif
        <div class="form-group">
            <button type="submit" id="user_login" class="btn btn-primary btn-block">Register</button>

        </div>
    </form>
    <p class="text-center"><a href="{{ route('site.user.login') }}">Back to Login</a></p>
</div>

@endsection
