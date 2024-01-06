@extends('dashboard.layout.app')

@section('title','users edit')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
    <li class="breadcrumb-item">edit</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{--{{route('admin.password.update',$user->id)}}--}}" >
                    @csrf
                    @method('put')
                    {{--x-form-errors--}}
                    <div class="form-group mb-1">
                        <label for="old_password" class="mb-1"> Old Password <span class="text-danger">*</span></label>
                        <input
                            type="password" name="old_password"
                            placeholder="old password" class="form-control">
                        @error('old_password')
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
