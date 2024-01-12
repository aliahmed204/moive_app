@extends('dashboard.layout.app')

@section('title','Movies')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.movies.index')}}">Movies</a></li>
    <li class="breadcrumb-item">Show</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">

                <div class="row">

                    <div class="col-md-2">
                        <img src="{{$movie->poster_path}}" class="img-fluid"  alt="">
                    </div>{{--end of col--}}

                    <div class="col-md-10">

                        <h2>{{$movie->title}}</h2>
                        @foreach($movie->genres as $genre)
                            <a href="{{route('admin.movies.index',['genre_id'=> $genre->id])}}" >
                                <span class="me-1 badge bg-success">{{$genre->name}}</span>
                            </a>
                        @endforeach

                        <p style="font-size: 16px;">{{$movie->description}}</p>

                        <div class="d-flex mb-2">
                            <i class="fa fa-star text-warning" style="font-size: 33px;"></i>
                            <h3 class="m-0 mx-2">{{$movie->vote}}</h3>
                            <p class="m-0 align-self-center">by {{$movie->vote_count}}</p>
                        </div>

                        <p><strong>Language</strong>: en</p>

                        <p><strong>Release Date</strong>: {{$movie->release_date->format('Y-m-d')}}</p>

                        <hr>

                        {{--images--}}
                        <div class="row gallery" >
                            @foreach($movie->images as $image)
                               <div class="col-md-3 mt-2 mb-2 ">
                                   <a href="{{$image->image_path}}">
                                        <img src="{{$image->image_path}}" class="img-fluid" alt="image">
                                   </a>
                               </div>
                            @endforeach
                        </div>
                        <hr>
                        {{--actors--}}
                        <div class="row">
                            @foreach($movie->actors as $actor)
                                <div class="col-md-3 mt-2 mb-2">
                                    <a href="{{route('admin.movies.index',['actor_id'=> $actor->id])}}" >
                                        <img src="{{$actor->image_path}}" class="img-fluid" alt="image">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>{{--end of col--}}

                </div>{{--end of row--}}

            </div>
        </div>
    </div>


@endsection

@push('js')
<script>
    $(function() { // the containers for all your galleries
        $('.gallery').magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            }
        });
    });
</script>
@endpush
