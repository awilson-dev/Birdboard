@extends('layouts.app')

@section('content')
    <div class="card lg:w-1/2 lg:mx-auto">
        <form method="POST" action="{{ route('login') }}" class="py-8 px-16">
            @csrf

            <h1 class="text-2xl font-normal mb-10 text-center">Login</h1>

            <div class="field mb-6">
                <label for="email" class="label text-sm mb-2 block">Email Address</label>

                <div class="control">
                    <input id="email" type="email"
                        class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="field mb-6">
                <label for="password" class="label text-sm mb-2 block">Password</label>

                <div class="control">
                    <input id="password" type="password"
                        class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="field mb-6">
                <div class="control">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="text-sm ml-2" for="remember">Remember Me</label>
                </div>
            </div>

            <div class="field mb-6">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="button">Login</button>

                    @if (Route::has('password.request'))
                        <a class="text-gray-400 text-sm underline ml-3" href="{{ route('password.request') }}">Forgot Your
                            Password?</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
