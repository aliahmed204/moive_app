{{--@if(auth()->user()->hasPermission('movies_show'))--}}
<a href="{{route('admin.movies.show',$id)}}" class="btn btn-warning btn-sm ">
    <i class="fa fa-eye"></i>
   Show
</a>
{{--@endif--}}

{{--@if(auth()->user()->hasPermission('movies_delete'))--}}
<form action="{{route('admin.movies.destroy',$id)}}" class="my-1 my-xl-0" method="post" style="display: inline-block">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm delete">
        <i class="fa fa-trash"></i>
       Delete
    </button>
</form>
{{--@endif--}}
