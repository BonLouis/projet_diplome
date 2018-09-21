@extends('layouts.master')
@section('content')
<div class="row py-5">
    <div class="col s12 m12">
        <div class="card">
            <div class="card-content">
                <span class="card-title"><h3>Se connecter</h3></span>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="{{ $errors->has('email') ? 'invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="{{ $errors->has('password') ? 'invalid' : '' }}" name="password" required>
                            <label for="password">{{ __('Password') }}</label>
                            <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="right">
                            <label for="remember">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>{{ __('Remember Me') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 right-align">
                            <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                            </button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection