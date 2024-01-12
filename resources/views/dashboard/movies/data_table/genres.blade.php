@foreach($movie->genres as $genre)
    <h5>
      <a href="{{route('admin.movies.index',['genre_id'=>$genre->id])}}" class="btn btn-warning btn-sm" >
        <span class="badge text-primary">
              {{$genre->name}}
        </span>
      </a>
    </h5>
@endforeach

