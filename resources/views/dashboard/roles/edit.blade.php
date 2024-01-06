@extends('dashboard.layout.app')

@section('title','roles')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">roles</a></li>
    <li class="breadcrumb-item">create</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <form method="post" action="{{route('admin.roles.update', [ 'role' => $role->id])}}">
                    @csrf
                    @method('put')
                    {{--x-form-errors--}}
                    <div class="form-group mb-1">
                        <label for="name">Role Name<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="name"
                                placeholder="name"
                                class="form-control"
                                autofocus
                                value="{{$role->name}}">

                    </div>
                    @php
                        $models =  ['roles', 'admins', 'clients', 'orders'];
                        $actions = ['create', 'read', 'update', 'delete'];
                    @endphp
                    <h5>permissions <span class="text-danger">*</span></h5>
                    <table class="table">
                      <thead>
                          <tr>
                              <th>Model</th>
                              <th>Permission</th>
                          </tr>
                      </thead>
                      <tbody>

                          @foreach ($models as $model)
                            <tr>
                                <td>{{ucfirst($model)}}</td>
                                <td>{{--chack all--}}
                                    <div class="animated-checkbox mx-2" >
                                        <label class="m-0">
                                            <input
                                                type="checkbox"
                                                name=""
                                                class="all-roles">
                                            <span class="label-text">All</span>
                                        </label>
                                    </div>
                                @foreach($actions as $action){{--chack one--}}
                                        <div class="animated-checkbox mx-2" style="display:inline-block" >
                                            <label class="m-0">
                                                <input
                                                    type="checkbox"
                                                    value="{{ $model.'_'.$action}}"
                                                    name="permissions[]"
                                                    @checked($role->hasPermission($model.'_'.$action))
                                                    class="role" >
                                                <span class="label-text">{{ucfirst($action)}}</span>
                                            </label>
                                        </div>
                                @endforeach

                                </td>
                            </tr>
                          @endforeach

                      </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Submit</button>

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
