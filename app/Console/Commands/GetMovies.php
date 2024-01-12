<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getPopularMovies();
        $this->getPlayingMovies();
        $this->getUpcomingMovies();

        dump(' movies added successfully - ');
    }

    private function getPopularMovies()
    {

        for( $i=1; $i <= config('services.tmdb.max_pages'); $i++)
        {
            $response = Http::get(config('services.tmdb.base_url').'/movie/popular?api_key='.config('services.tmdb.api_key').'&page='."$i");

            foreach($response->json()['results'] as $result){

                $movie =Movie::updateOrCreate(
                    [
                        'external_id' => $result['id'],
                        'title'       => $result['title'],
                    ],[
                    'description' => $result['overview'],
                    'poster'      => $result['poster_path'],
                    'banner'      => $result['backdrop_path'],
                    'release_date' => $result['release_date'],
                    'vote'        => $result['vote_average'],
                    'vote_count'  => $result['vote_count']
                ]);

                $this->attachGenres($result,$movie);
                $this->attachActors($movie);
                $this->attachImages($movie);

            }//end of foreach

        }//end of for
       // Command::SUCCESS('popular movies added successfully');

    }//end of popular-movies
    private function getPlayingMovies()
    {
        for( $i=1; $i <= config('services.tmdb.max_pages'); $i++)
        {
            $response = Http::get(config('services.tmdb.base_url').'/movie/now_playing?api_key='.config('services.tmdb.api_key').'&page='."$i");

            foreach($response->json()['results'] as $result){

                $movie = Movie::updateOrCreate(
                    [
                        'external_id' => $result['id'],
                        'title'       => $result['title'],
                    ],[
                    'description' => $result['overview'],
                    'poster'      => $result['poster_path'],
                    'banner'      => $result['backdrop_path'],
                    'type'        => 'playing',
                    'release_date' => $result['release_date'],
                    'vote'        => $result['vote_average'],
                    'vote_count'  => $result['vote_count'],
                ]);

                $this->attachGenres($result,$movie);
                $this->attachActors($movie);
                $this->attachImages($movie);

            }//end of foreach

        }//end of for
       // Command::SUCCESS('popular movies added successfully');
        dump('playing now movies added successfully - '.$i);
    }// end of playing movies

    private function getUpcomingMovies()
    {
        for( $i=1; $i <= config('services.tmdb.max_pages'); $i++)
        {
            $response = Http::get(config('services.tmdb.base_url').'/movie/upcoming?api_key='.config('services.tmdb.api_key').'&page='."$i");

            foreach($response->json()['results'] as $result){

                $movie = Movie::updateOrCreate(
                    [
                        'external_id' => $result['id'],
                        'title'       => $result['title'],
                    ],[
                    'description' => $result['overview'],
                    'poster'      => $result['poster_path'],
                    'banner'      => $result['backdrop_path'],
                    'type'        => 'upcoming',
                    'release_date' => $result['release_date'],
                    'vote'        => $result['vote_average'],
                    'vote_count'  => $result['vote_count'],
                ]);

                $this->attachGenres($result,$movie);
                $this->attachActors($movie);
                $this->attachImages($movie);

            }//end of foreach

        }//end of for
       // Command::SUCCESS('popular movies added successfully');
        dump('playing now movies added successfully - '.$i);
    }// end of playing movies

    private function attachGenres($result,Movie $movie)
    {
        foreach($result['genre_ids'] as $genreId){
            $genre = Genre::where('external_id', $genreId)->first();
            $movie->genres()->syncWithoutDetaching($genre->id);
        }
    }

    private function attachActors(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url').'/movie/'.$movie->external_id.'/credits?api_key='.config('services.tmdb.api_key'));

        foreach($response->json()['cast'] as $index=>$result){

            if($result['known_for_department'] != 'Acting') continue;

            if($index == 5) break;

                $actor = Actor::where('e_id' , $result['id'])->first();
                if(!$actor){
                    $actor = Actor::Create([
                        'e_id'   => $result['id'],
                        'name'   => $result['name'],
                        'image'  => $result['profile_path'],
                        'gender' => $result['gender'],
                        'character' => $result['character'],
                    ]);
                }
                // not deleting
                $movie->actors()->syncWithoutDetaching($actor->id);


        }

    }

    private function attachImages(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url').'/movie/'.$movie->external_id.'/images?api_key='.config('services.tmdb.api_key'));

        $movie->images()->delete();

        foreach($response->json()['backdrops'] as $index=>$result){

            if($index == 8) break;

            Image::create([
                'image' => $result['file_path'],
                'imageable_id' => $movie->id,
                'imageable_type' => Movie::class,
            ]);

        }//end of foreach

    }// end of function


}
