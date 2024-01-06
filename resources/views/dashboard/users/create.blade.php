@extends('dashboard.layout.app')

@section('title','users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
    <li class="breadcrumb-item">create</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{route('admin.users.store')}}">
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
                    <div class="form-group mb-1">
                        <label for="email" class="mb-1">Email <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            name="email"
                            placeholder="email"
                            class="form-control"
                            value="{{old('email')}}">
                        @error('email')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="password" class="mb-1">Password <span class="text-danger">*</span></label>
                        <input
                            type="password" name="password" autocomplete="false"
                            placeholder="password" class="form-control">
                        @error('password')
                        <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="password_confirmation" class="mb-1">Password Confirmation <span class="text-danger">*</span></label>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="confirm password"
                            class="form-control">
                    </div>



                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create</button>

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
