@extends('layouts.dashboard')

@section('content')
    <div class="col-12">

        <form method="post" action="{{ route('products.store') }}">
            @csrf

            <div class="form-group mt-2">
                <label for="name">Додади Продукт:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                       value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                       value="{{ old('title') }}">
                @error('title')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                       id="slug" value="{{ old('slug') }}">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="image">Image</label>
                <input type="text" name="image" class="form-control @error('description') is-invalid @enderror"
                       id="image" value="{{ old('image') }}">
            </div>

            @error('image')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <div class="form-group mt-2">
                <label for="user">Category_id</label>
                <select class="form-control" id="user" name="category_id">
                    @foreach($users as $user)
                        <option value="{{  $category_id->id }}">{{ $category_id->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('category_id')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <div class="form-group mt-2">
                <label for="description">Description</label>
                <textarea id="description" name="description"
                          class="form-control @error('description') is-invalid @enderror">


                {{ old('description') }}
                </textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>


            <div class="form-group mt-2">
                <label for="user">User</label>
                <select class="form-control" id="user" name="user_id">
                    @foreach($users as $user)
                        <option value="{{  $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('image')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror


            <div class="form-group">

                <button type="submit" class="btn btn-primary mt-xl-4">Add product</button>
            </div>

        </form>


    </div>
@endsection
