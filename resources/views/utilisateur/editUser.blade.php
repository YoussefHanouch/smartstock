@extends('layouts.app')

@section('user')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  text-white text-center">
                    <h3 style="color: #007bff">Modifier un Admin</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('updateutilisateur', $user->id) }}">
                        @csrf
                        @method('PUT') 

                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Prénom & nom</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if(auth()->user()->role === 'super_admin')
                            <div class="form-group mb-4">
                                <label for="role" class="form-label">Rôle</label>
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                                    <option value="super_admin" @if($user->role === 'super_admin') selected @endif>Super Admin</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        @endif

                        <div class="form-group">
                            <button type="submit" style="background-color: #007bff" class="btn btn-success btn-block mt-3">Modifier</button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 900px;
        margin-top: 50px;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 20px;
    }
    .card-body {
        padding: 20px;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 1rem;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }
    .btn {
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
    }
    .btn-success:hover {
        background-color: #218838;
    }
    .btn-block {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        margin: 10px 0;
    }
    .invalid-feedback {
        display: block;
        color: #dc3545;
        margin-top: 5px;
    }
    .card-footer {
        padding: 10px 20px;
        background-color: #f8f9fa;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        text-align: center;
    }
</style>
