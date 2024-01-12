@extends('dashboard.layout.app')

@section('title','genres')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.Genres.index')}}">Genres</a></li>
    <li class="breadcrumb-item">create</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{route('admin.genres.store')}}">
                    @csrf
                    {{--x-form-errors--}}
                    <div class="form-group mb-1">
                        <label for="name" class="mb-1">Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                placeholder="name"
                                class="form-control"
                                autofocus
                                value="{{old('name')}}">
                        @error('name')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create</button>

                </form>

            </div>
        </div>
    </div>


@endsection

@push('js')

@endpush
