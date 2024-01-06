@extends('dashboard.layout.app')

@section('title','roles edit')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.admins.index')}}">Admins</a></li>
    <li class="breadcrumb-item">edit</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{route('admin.admins.update',$admin->id)}}">
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
                                value="{{$admin['name']}}">
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
                            value="{{$admin['email']}}">
                        @error('email')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="password" class="mb-1">Password </label>
                        <input
                            type="password" name="password"
                            placeholder="password" class="form-control">
                        @error('password')
                        <span class="badge text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="password_confirmation" class="mb-1">Password Confirmation </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="confirm password"
                            class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label for="password_confirmation" class="mb-1">Role <span class="text-danger">*</span></label>
                        <select id="role" name="role_id" class="form-control select2">
                            <option disabled>--Choose Role--</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @selected(in_array($role->id ,$admin_roles)) >{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
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
