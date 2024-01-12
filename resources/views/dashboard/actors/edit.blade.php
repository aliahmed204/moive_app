@extends('dashboard.layout.app')

@section('title','genres')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.Genres.index')}}">Genres</a></li>
    <li class="breadcrumb-item">edit</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{route('admin.genres.update',$genre->id)}}">
                    @csrf
                    @method('put')
                    {{--x-form-errors--}}
                    <div class="form-group mb-1">
                        <label for="name" class="mb-1">Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                placeholder="name"
                                class="form-control"
                                autofocus
                                value="{{$genre['name']}}">
                        @error('name')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Update </button>

                </form>

            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $(document).on('change','.all-roles',function(){
            $(this).parents('tr').find('input[type="checkbox"]').prop('checked', this.checked);
        })

        $(document).on('change','.role',function(){
            if(!this.checked){
                $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            }
        })


    </script>

@endpush
