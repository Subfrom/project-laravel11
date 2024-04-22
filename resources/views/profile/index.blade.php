@extends('layouts.app')

@section('content')
<style>
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .avatar-wrapper {
            width: 150px;
            height: 150px;
            overflow: hidden;
            border-radius: 50%;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-pic {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        h3 {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="avatar-wrapper">
                        <img class="profile-pic" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" />
                    </div>
                    <h3 style="text-align: center">{{ Auth::user()->name }}</h3>
                    <h3 style="text-align: center">{{ Auth::user()->email }}</h3>
                    <div class="col-12 d-flex justify-content-center">
                        <div class="m-2">
                          <a href="{{ route('editprofile') }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                        <div class="m-2">
                          <button class="btn btn-primary">Change Password</button>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
