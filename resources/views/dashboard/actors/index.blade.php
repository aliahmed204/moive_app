@extends('dashboard.layout.app')

@section('title','Actors')

@section('breadcrumb')
    <li class="breadcrumb-item">Actors</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                {{----}}
                <div class="row mb-2">
                    <div class="col-md-12">

                    {{--@if(auth()->user()->hasPermission('genres_delete'))--}}
                        <form action="{{route('admin.actors.bulk_delete')}}" class="my-1 my-xl-0" method="post" style="display: inline-block">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="record_ids" id="record-ids" >
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled>
                                <i class="fa fa-trash"></i>
                                Bulk Delete
                            </button>
                        </form>
                    {{--@endif--}}

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
                                    <table class="table dataTable" id="actors-table">
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
                                            <th>image</th>
                                            <th>name</th>
                                            <th>movies_count</th>
                                            <th>related_movies</th>
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

    <script>

     let movie;
     let actorsTable = $("#actors-table").DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{route('admin.actors.data')}}",
                data: function (d){
                    d.movie_id = movie;
                }
            },
            columns:[
                 { data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%' },
                 { data: 'image', name: 'image', searchable: false , sortable: false },
                 { data: 'name', name: 'name' , width:'15%' },
                 { data: 'movies_count', name: 'movies_count' , width:'15%' },
                 { data: 'related_movies', name: 'related_movies', searchable: false,sortable: false },
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
            actorsTable.search(this.value).draw();
        });

        $('#movie').on('change',function(){
            movie = this.value;
            actorsTable.ajax.reload();
        });

    </script>


@endpush
