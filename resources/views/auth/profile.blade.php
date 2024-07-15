<!-- resources/views/user/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="user">
        <h1>{{ $user->name }} </h1>
        <a href="{{ route('edit-user', ['id' => $user_id]) }}">{{__('Edit')}}</a>
    </div>
    <p>Email: {{ $user->email }}</p>
    <p>Created At: {{ $user->created_at }}</p>
    
    <h2>Hobbies</h2>
    <ul>
        @if($user->hobbies && $user->hobbies->isNotEmpty())
            @foreach($user->hobbies as $hobby)
                <li>{{ $hobby->name }}</li>
            @endforeach
        @else
            <li>{{ __('No record found')}}</li>
        @endif
    </ul>
</div>
@endsection
