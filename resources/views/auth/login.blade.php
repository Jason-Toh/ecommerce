@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="text-center">
                <h1>Login Account</h1>
            </div>
            <form role="form" method="POST" action="{{ route('post_login') }}">
                @csrf
                {{-- https://stackoverflow.com/questions/36885413/how-to-display-validation-errors-next-to-each-related-input-field-in-laravel-5/55030568#55030568 --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
