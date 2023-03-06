@extends('layouts.dashboard')
@section('content')
    <div class="col-12">
        <div class="row ">
            <div class="col-8">

                <form method="post" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-roup mt-2">
                        <label for="name">Title</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="YourName" name="name">
                    </div>
                    @error('name')
                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror



                    <div class="form-group mt-2">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    @error('email')
                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror



                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="passwordHelp" name="password">
                    </div>
                    @error('password')
                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <div class="form-group mt-2">
                        <label for="role">Roles</label>
                        <select name="role_id" class="form-control" id="role">

                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}} </option>
                            @endforeach

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary mt-xl-4">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
