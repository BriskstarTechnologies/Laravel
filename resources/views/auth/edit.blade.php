@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-user', $user->id) }}" enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="1" {{ (old('gender') == 1  || $user->gender == 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">
                                        {{__('Male')}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="2" {{ (old('gender') == 2 || $user->gender == 2) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">                                  
                                        {{__('Female')}}
                                    </label>
                                </div>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($hobbies) 
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Hobbies') }}</label>
                            <div class="col-md-6">
                                @foreach($hobbies as $key => $hobbie)
                                <input class="form-check-input" type="checkbox" name="hobbies[]" id="{{ $key }}" value="{{ $key }}"
                                    {{ is_array(old('hobbies')) && in_array($key, old('hobbies')) ? 'checked' : (in_array($key, $userHobbies) ? 'checked' : '') }}>
                                <label class="form-check-label" for="{{ $key }}">
                                    {{ $hobbie }}
                                </label>
                                @endforeach
                                
                                @error('hobbies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>

                            <div class="col-md-6">
                            <input class="form-control" type="file" id="formFile" name="profile_pic">

                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($user->profile_pic)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
