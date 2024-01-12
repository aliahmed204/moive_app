@extends('dashboard.layout.app')

@section('title','Movies')

@section('breadcrumb')
    <li class="breadcrumb-item">Movies</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                {{----}}
                <div class="row mb-2">
                    <div class="col-md-12">

                    {{--@if(auth()->user()->hasPermission('genres_delete'))--}}
                        <form action="{{route('admin.movies.bulk_delete')}}" class="my-1 my-xl-0" method="post" style="display: inline-block">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <select id="genre" class="form-control select22">
                                    <option value="">--All Genres--</option>
                                    @foreach($genres as $genre)
                                        <option value="{{$genre->id}}" @selected($genre->id == request()->genre_id)>{{$genre->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--actors--}}
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <div class="form-group">
                                <select id="actor" class="form-control select2">
                                    <option value="">--All actors--</option>
                                    @if($actor)
                                        <option value="{{$actor->id}}" @selected($actor->id == request()->actor_id)>{{$actor->name}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--type--}}
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <div class="form-group">
                                <select id="type" class="form-control select22">
                                    <option value="">--All Movies--</option>
                                    @foreach(['playing','upcoming'] as $type)
                                        <option value="{{$type}}">{{ucfirst($type)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table dataTable" id="movies-table">
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
                                            <th>genres</th>
                                            <th>vote</th>
                                            <th>vote_count</th>
                                            <th>release_date</th>
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

     let genre = "{{ request()->genre_id }}";
     let actor = "{{ request()->actor_id }}";
     let type   = "{{ request()->type }}";
     let moviesTable = $("#movies-table").DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{route('admin.movies.data')}}",
                data: function (d){
                    d.genre_id = genre;
                    d.actor_id = actor;
                    d.type = type;
                }
            },
            columns:[
                 { data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%' },
                 { data: 'poster', name: 'poster', searchable: false , sortable: false },
                 { data: 'title', name: 'title' , width:'15%' },
                 { data: 'genres', name: 'genres', searchable: false , sortable: false },
                 { data: 'vote', name: 'vote', searchable: false },
                 { data: 'vote_count', name: 'vote_count', searchable: false },
                 { data: 'release_date', name: 'release_date', searchable: false },
                 { data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%' },
            ],
            order: [[5, 'desc']],
            drawCallback: function(settings){
                $('.record__select').prop('checked',false);
                $('#record__select-all').prop('checked',false);
                $('#records-ids').val();
                $('#bulk-delete').attr('disabled',true);
            }
        });

        $('#data-table-search').keyup(function() {
            moviesTable.search(this.value).draw();
        });

        $('#genre').on('change',function(){
            genre = this.value;
            moviesTable.ajax.reload();
        });

        $('#actor').on('change',function(){
            actor = this.value;
            moviesTable.ajax.reload();
        });

        $('#type').on('change',function(){
            type = this.value;
            moviesTable.ajax.reload();
        });


     $('#actor').select2({
         ajax: {
             url: "{{ route('admin.actors.index') }}",
             dataType: 'json',
             delay: 250,
             data: function (params) {
                 return {
                     search: params.term,
                 };
             },
             processResults: function (data) {
                 return {
                     results: data
                 };
             },

         }
     });

    </script>



@endpush
