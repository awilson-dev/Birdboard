@extends('layouts.app')

@section('content')
    <div class="card lg:w-1/2 lg:mx-auto">
        <form method="POST" action="{{ route('password.update') }}" class="py-8 px-16">
            @csrf

            <h1 class="text-2xl font-normal mb-10 text-center">Reset Password</h1>

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field mb-6">
                <label for="email" class="label text-sm mb-2 block">Email Address</label>

                <div class="control">
                    <input id="email" type="email"
                        class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="field mb-6">
                <label for="password-confirm" class="label text-sm mb-2 block">Confirm Password</label>

                <div class="control">
                    <input id="password-confirm" type="password"
                        class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="field mb-6">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="button">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
