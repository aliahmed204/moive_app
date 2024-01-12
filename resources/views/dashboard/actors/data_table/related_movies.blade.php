{{--@if(auth()->user()->hasPermission('genres_delete'))--}}
<a href="{{route('admin.movies.index',['actor_id'=>$id])}}" class="btn btn-warning btn-sm" >
        <i class="fa fa-eye"></i>
        related_movies
</a>
{{--@endif--}}
