@extends('dashboard.layout.app')

@section('title','InBox')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
@endsection

@section('content')

    <div class="row" id="top-statics">
        <div class="col-md-4">
            <div class="widget-small primary coloured-icon"><i class="icon bi  bi-list fs-1"></i>
                <div class="info">
                    <a href="{{'admin.genres.index'}}"><h4>{{ucfirst('genres')}}</h4></a>
                    <div class="loader loader-sm"></div>
                    <p id="genres-count" style="display: none"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="widget-small info coloured-icon"><i class="icon bi bi-film fs-1"></i>
                <div class="info">
                    <a href="{{'admin.movies.index'}}"><h4>{{ucfirst('movies')}}</h4></a>
                    <div class="loader loader-sm"></div>
                    <p id="movies-count" style="display: none;"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-star fs-1"></i>
                <div class="info">
                    <a href="{{'admin.actors.index'}}"><h4>{{ucfirst('actors')}}</h4></a>
                    <div class="loader loader-sm"></div>
                    <p id="actors-count" style="display: none;"></p>
                </div>
            </div>
        </div>


        {{--<div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon bi bi-star fs-1"></i>
                <div class="info">
                    <h4>Stars</h4>
                    <p><b>500</b></p>
                </div>
            </div>
        </div>--}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title"> Movies Chart </h3>
                    <select id="movies-chart-year" style="width: 100px;" class="form-select">
                        @for($i=5 ; $i >= 0 ; $i--)
                            <option value="{{now()->subYears($i)->year}}"
                                @selected(now()->subYears($i)->year == now()->year)
                            >
                                {{now()->subYears($i)->year}}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="movie-chart-wrapper">
                    {{--@include('dashboard._movies_chart')--}}
                </div>
            </div>
        </div>

    </div>
    {{-- popularMovies --}}
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex my-2">
                    <h3 class="tile-title">
                        Top Popular Movies
                    </h3>
                    <span class="m-1"> <a href="{{route('admin.movies.index')}}" >Show All..</a></span>
                </div>
                <div>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th style="width: 30%">Title</th>
                            <th>Vote</th>
                            <th>Vote Count</th>
                            <th>Release Date</th>
                        </tr>
                        @foreach($popularMovies as $movie)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('admin.movies.show',$movie->id)}}">
                                        {{$movie->title}}
                                    </a>
                                </td>
                                <td>
                                    <i class="fa fa-star text-warning"></i>
                                    <span class="my-2">{{$movie->vote}}</span>
                                </td>
                                <td>{{$movie->vote_count}}</td>
                                <td>{{$movie->release_date->format('Y-m-d')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- $nowPlayingMovies --}}
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex my-2">
                    <h3 class="tile-title">
                        Top Now Playing Movies
                    </h3>
                    <span class="m-1"> <a href="{{route('admin.movies.index',['type'=>'playing'])}}">Show All..</a></span>
                </div>
                <div>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th style="width: 30%">Title</th>
                            <th>Vote</th>
                            <th>Vote Count</th>
                            <th>Release Date</th>
                        </tr>
                        @foreach($nowPlayingMovies as $movie)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('admin.movies.show',$movie->id)}}">
                                        {{$movie->title}}
                                    </a>
                                </td>
                                <td>
                                    <i class="fa fa-star text-warning"></i>
                                    <span class="my-2">{{$movie->vote}}</span>
                                </td>
                                <td>{{$movie->vote_count}}</td>
                                <td>{{$movie->release_date->format('Y-m-d')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- $upComingMovies --}}
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex my-2">
                    <h3 class="tile-title">
                        Top Upcoming Movies
                    </h3>
                    <span class="m-1"> <a href="{{route('admin.movies.index',['type'=>'upcoming'])}}">Show All..</a></span>
                </div>
                <div>
                    <table class="table ">
                        <tr  >
                            <th>#</th>
                            <th style="width: 30%">Title</th>
                            <th>Vote</th>
                            <th>Vote Count</th>
                            <th>Release Date</th>
                        </tr>
                        @foreach($upComingMovies as $movie)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('admin.movies.show',$movie->id)}}">
                                        {{$movie->title}}
                                    </a>
                                </td>
                                <td>
                                    <i class="fa fa-star text-warning"></i>
                                    <span class="my-2">{{$movie->vote}}</span>
                                </td>
                                <td>{{$movie->vote_count}}</td>
                                <td>{{$movie->release_date->format('Y-m-d')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Page specific javascripts-->


    <script>

        $(function() {

           topStatics();

           /* to render chart on loading the page */
            moviesChart("{{now()->year}}");
           /* to make filter */
           $('#movies-chart-year').on('change', function(){

                let year = $(this).find(':selected').val();

                moviesChart(year);
            });

       });

        function topStatics() {
            $.ajax({
                url: "{{route('admin.home_statics')}}",
                cache: false,
                success: function (data){
                    console.log(data);
                    $('#top-statics .loader').hide();

                    $('#top-statics #genres-count').text(data.genres_count).show();
                    $('#top-statics #actors-count').text(data.actors_count).show();
                    $('#top-statics #movies-count').text(data.movies_count).show();

                }
            })
        }

        function moviesChart(year){

            let loader = `
                <div class="d-flex justify-content-center align-items-center">
                     <div class="loader loader-md" id="loader-chart"></div>
                </div>
           `
            let chartDiv = $('.movie-chart-wrapper');

            chartDiv.empty().append(loader);

            $.ajax({
                url: "{{route('admin.movies_chart')}}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html){

                    chartDiv.empty().append(html);
                }
            })
    }

    </script>

@endpush
