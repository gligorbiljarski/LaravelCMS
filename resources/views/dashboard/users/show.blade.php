@extends('layouts.dashboard')
@section('content')
    <div class="col-12">
        <h1>Welcome {{ $user->name }}</h1>
        <p>Your email address is: {{ $user->email }}</p>
        <p>You have created your account {{ $user->created_at->diffForHumans() }}</p>
    </div>
@endsection
