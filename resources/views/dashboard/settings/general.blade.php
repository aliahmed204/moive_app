@extends('dashboard.layout.app')

@section('title','Settings')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item">edit</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{route('admin.settings.store')}}" enctype="multipart/form-data">
                    @csrf
                    {{--x-form-errors--}}
                    <div class="form-group mb-1">
                        <label for="logo" class="mb-1"> Logo <span class="text-danger">*</span></label>
                        <input
                            type="file"
                            name="logo"
                            placeholder="name"
                            class="form-control load-image"
                            ><br>
                        <img
                            src="{{Storage::url('uploads/'.setting('logo'))}}"
                            class="loaded-image" alt=""
                            width="100" height="80"
                            style="display: {{ setting('logo') ? 'block' : 'none' }}"
                        >
                        @error('fav_icon')
                        <span class="badge text-danger">{{$message}}</span>
                        @enderror

                    </div>
                    <div class="form-group mb-1">
                        <label for="fav_icon" class="mb-1">Favourite Icon <span class="text-danger">*</span></label>
                            <input
                                type="file"
                                name="fav_icon"
                                placeholder="fav_icon"
                                class="form-control load-image" ><br>
                        <img
                            src="{{Storage::url('uploads/'.setting('fav_icon'))}}"
                            class="loaded-image" alt=""
                            width="100" height="80"
                            style="display: {{ setting('fav_icon') ? 'block' : 'none' }}"
                        >
                        @error('fav_icon')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror

                    </div>
                    {{--Title--}}
                    <div class="form-group mb-1">
                        <label for="title" class="mb-1">Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="title"
                            placeholder="title"
                            class="form-control"
                            value="{{setting('title')}}">
                        @error('title')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{--Description--}}
                    <div class="form-group mb-1">
                        <label for="title" class="mb-1">Description <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="description"
                            placeholder="Description"
                            class="form-control"
                            value="{{setting('description')}}">
                        @error('description')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{--KeyWords--}}
                    <div class="form-group mb-1">
                        <label for="title" class="mb-1">Keywords <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="keywords"
                            placeholder="Keywords"
                            class="form-control"
                            value="{{setting('keywords')}}">
                        @error('keywords')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{--Email--}}
                    <div class="form-group mb-1">
                        <label for="title" class="mb-1">Email <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            name="email"
                            placeholder="email"
                            class="form-control"
                            value="{{setting('email')}}">
                        @error('email')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div> <br>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update </button>
                </form>

            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        $(document).on('change','.load-image',function(e){
            var img = $(this);
            let reader = new FileReader();

            console.log('Loading');
            reader.onload = function(){
                img.parent().find('.loaded-image').attr('src',reader.result);
                img.parent().find('.loaded-image').css('display','block');
            };

            reader.readAsDataURL(e.target.files[0]);

        });
    </script>
@endpush
