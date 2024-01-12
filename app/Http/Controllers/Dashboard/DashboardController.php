<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $popularMovies = Movie::where('type',null)
            ->orderBy('vote_count','desc')
            ->limit(5)
            ->get();

        $nowPlayingMovies = Movie::where('type','playing')
            ->orderBy('vote_count','desc')
            ->limit(5)
            ->get();

        $upComingMovies = Movie::where('type','upcoming')
            ->orderBy('vote_count','desc')
            ->limit(5)
            ->get();

        return view('dashboard.index',compact('popularMovies', 'upComingMovies','nowPlayingMovies'));
    }

    public function home_statics()
    {
        $genresCount = number_format(Genre::count(),1);
        $moviesCount = number_format(Movie::count(),1);
        $actorsCount = number_format(Actor::count(),1);

        return response()->json([
            'genres_count' => $genresCount,
            'actors_count' => $actorsCount,
            'movies_count'  => $moviesCount,
        ]);
    }

    public function movies_chart()
    {
        $chart = Movie::whereYear('release_date', request()->year)
            ->select(
                DB::raw('YEAR(release_date) as year'),
                DB::raw('MONTH(release_date) as month'),
                DB::raw('COUNT(id) as total_movies')
            )
            ->groupBy('month','year')
            ->get();

        return view('dashboard._movies_chart',compact('chart'));

    }


}
