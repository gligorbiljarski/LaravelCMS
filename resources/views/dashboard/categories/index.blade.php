@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">

                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif

                <p>


                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2 me-2">
                                                <span class="material-symbols-rounded align-middle me-2">
                                                    settings
                                                    </span> Додади категорија</a>
                </p>

            </div>
        </div>
        <div class="row">

            <div class="col-xl-12 mb-0 mb-lg-12">


                <div class="card h-100 table-card table-nowrap">
                    <div class="card-body">
                        {!! $categories !!}
                    </div>






                </div>
            </div>


        </div>


    </div>
@endsection


