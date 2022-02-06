@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- offset increases left margin by 4 columns --}}
        <div class="col-md-4 offset-md-4">
            <div class="text-center">
                <h1>Register Account</h1>
            </div>
            <form role="form" method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="current-password" required>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password_confirmation" autocomplete="current-password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
