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

                <form method="post" action="{{route('admin.users.update',$user->id)}}">
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
                                value="{{$user['name']}}">
                        @error('name')
                            <span class="badge text-danger">{{$message}}</span>
                        @enderror

                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="mb-1">Email <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            name="email"
                            placeholder="email"
                            class="form-control"
                            value="{{$user['email']}}">
                        @error('email')
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
