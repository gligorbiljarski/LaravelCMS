@extends('layouts.dashboard')
@section('content')

    <div class="row">
        <div class="col-4">
            <a href="{{ route('users.create') }}" class="btn btn-success ">+ Додади Корисник</a>
        </div>
    </div>
    <div class="row-cols-md-12">
        <div class="row">
            <table class="table mt-xl-4">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Корисник</th>
                    <th>Улога</th>
                    <th>Акција</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{ route('users.show', $user->id) }}">{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>

                        <td><a href="{{ route('users.edit', $user->id) }}"  class="fs-2 text-primary d-block mb-2 bi bi-eye"></a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}"  class="fs-2 text-primary d-block mb-2 bi bi-pen"></a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}"  class="fs-2 text-primary d-block mb-2 bi bi-archive"></a></td>




                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
