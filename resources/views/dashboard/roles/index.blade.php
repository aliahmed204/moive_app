@extends('dashboard.layout.app')

@section('title','roles')

@section('breadcrumb')
    <li class="breadcrumb-item">roles</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                {{----}}
                <div class="row mb-2">
                    <div class="col-md-12">
                        {{--create--}}
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                           <i class="fa fa-plus-square"></i>
                            Create
                        </a>
                        <form action="{{route('admin.roles.bulk_delete')}}" class="my-1 my-xl-0" method="post" style="display: inline-block">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="record_ids" id="record-ids" >
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled>
                                <i class="fa fa-trash"></i>
                                Delete
                            </button>

                        </form>

                    </div>
                </div>
                {{----}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" placeholder="search..." autofocus >
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table dataTable" id="roles-table">
                                        <thead>
                                        <tr>
                                            <th>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" id="record__select-all" >
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th>role name</th>
                                            <th>admins count</th>
                                            <th>created at</th>
                                            <th>actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@push('js')

    <!-- Page specific javascripts-->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{asset('dashboard')}}/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('dashboard')}}/js/plugins/dataTables.bootstrap.min.js"></script>

    <script>

     let rolesTable = $("#roles-table").DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            /*"language":{
                "url": "{{asset('dashboard/datatable-lang/'.app()->getLocale().'.json')}}"
            },*/
            ajax:{
                url: "{{route('admin.roles.data')}}"
            },
            columns:[
                 { data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%' },
                 { data: 'name', name: 'name' },
                 { data: 'users_count', name: 'users_count', searchable: false },
                 { data: 'created_at', name: 'created_at', searchable: false },
                 { data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%' },
            ],
            order: [[3, 'desc']],
            drawCallback: function(settings){
                $('.record__select').prop('checked',false);
                $('#record__select-all').prop('checked',false);
                $('#records-ids').val();
                $('#bulk-delete').attr('disabled',true);
            }
        });

        $('#data-table-search').keyup(function() {
           rolesTable.search(this.value).draw();
        });
    </script>


@endpush
