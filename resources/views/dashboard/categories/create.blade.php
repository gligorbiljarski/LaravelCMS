@extends('layouts.dashboard')

@section('content')


    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-1">Категории</h5>

                    @if(Session::has('flash_message'))
                        <p class="alert alert-info">Успешно креиравте Категорија</p>
                    @endif
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="{{ route('categories.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="inputImage" data-tippy-placement="bottom"
                                   data-tippy-content="Изберете слика" class="btn btn-primary me-3">
                                Изберете слика
                            </label>
                            <input type="file"
                                   class="form-control d-none w-0 h-0 position-absolute @error('image') is-invalid @enderror"
                                   id="inputImage" name="image">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label for="title" class="form-label">Наслов на категорија</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Опис</label>
                            <textarea name="desc" id="description" placeholder="Textarea"
                                      class="form-control quill-editor"></textarea>
                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label for="parent_id" class="form-label">Под категорија</label>
                            <select id="parent_id" class="form-select" name="parent_id">
                                <option value="">Главна Категорија</option>
                                {!! $categories !!}
                            </select>
                        </div>


                        <div class="col-12 col-md-12 mb-4 text-center">
                            <button class="btn btn-primary mb-2 me-2"><span class="material-symbols-rounded align-middle me-2"></span> Додади
                            </button>

                            <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-2 me-2">
                                                <span class="material-symbols-rounded align-middle me-2">
                                                                                                        </span> Назад</a>
                        </div>

                    </form>
                </div>
            </div>

@endsection
