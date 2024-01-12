<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GenreController extends Controller
{
    public function index()
    {
        return view('dashboard.genres.index');
    }
    public function data()
    {
        $genres = Genre::withCount(['movies']);

        return DataTables::of($genres)
            ->addColumn('record_select','dashboard.genres.data_table.record_select')
            ->addColumn('related_movies','dashboard.genres.data_table.related_movies')
            ->editColumn('created_at', function (Genre $genre) {
                return $genre->created_at->format('Y-m-d');
            })
            ->addColumn('actions','dashboard.genres.data_table.actions')
            ->rawColumns(['record_select','related_movies','actions'])
            ->toJson();
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return to_route('admin.genres.index')->with('success','data deleted successfully');
    }
    public function bulk_delete(Request $request)
    {
        $ids = json_decode($request->record_ids);
        Genre::destroy($ids);
        return to_route('admin.genres.index')->with('success','data deleted successfully');
    }
}
