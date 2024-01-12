<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('permission:movie_read')->only('index');
    }*/

    public function index()
    {
        $genres = Genre::get();

        $actor = (request()->actor_id) ? Actor::find(request()->actor_id) : null;

        return view('dashboard.movies.index',compact('genres','actor'));
    }
    public function data()
    {
        $movies = Movie::whenGenreId(request()->genre_id)
                        ->whenActorId(request()->actor_id)
                        ->whenType(request()->type)
                        ->with('genres')->select();

        return DataTables::of($movies)
            ->addColumn('record_select','dashboard.movies.data_table.record_select')
            ->addColumn('genres',function (Movie $movie) {
                return view('dashboard.movies.data_table.genres',compact('movie'));
            })->addColumn('poster',function (Movie $movie) {
                return view('dashboard.movies.data_table.poster',compact('movie'));
            })->addColumn('vote','dashboard.movies.data_table.vote')
            ->editColumn('release_date', function (Movie $movie) {
                return $movie->release_date->format('Y-m-d');
            })
            ->addColumn('actions','dashboard.movies.data_table.actions')
            ->rawColumns(['record_select','poster','genres','vote','actions'])
            ->toJson();
    }

    public function show(Movie $movie)
    {
        //egar loading
        $movie->load(['genres','actors','images']);
        return view('dashboard.movies.show', compact('movie'));
    }
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return to_route('admin.movies.index')->with('success','data deleted successfully');
    }
    public function bulk_delete(Request $request)
    {
        $ids = json_decode($request->record_ids);
        Movie::destroy($ids);
        return to_route('admin.movies.index')->with('success','data deleted successfully');
    }
}
