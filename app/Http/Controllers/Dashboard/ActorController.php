<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ActorController extends Controller
{
    public function index()
    {
        if(\request()->ajax()){
            $actors = Actor::where('name', 'like', '%'.request()->search.'%')
            ->limit(10)->get();

            $result = [];
            $result[] = ['id'=>'','text'=>'All Actors'];
            foreach($actors as $actor){
                $result[] = ['id' => $actor->id, 'text' => $actor->name];
            }
            return json_encode($result);
        }
        return view('dashboard.actors.index');
    }
    public function data()
    {
        $actors = Actor::withCount('movies');

        return DataTables::of($actors)
            ->addColumn('record_select','dashboard.actors.data_table.record_select')
            ->addColumn('image',function (Actor $actor) {
                return view('dashboard.actors.data_table.image',compact('actor'));
            })
            ->addColumn('related_movies','dashboard.actors.data_table.related_movies')
            ->addColumn('actions','dashboard.actors.data_table.actions')
            ->rawColumns(['record_select','image','related_movies','actions'])
            ->toJson();
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();
        return to_route('admin.actors.index')->with('success','data deleted successfully');
    }
    public function bulk_delete(Request $request)
    {
        $ids = json_decode($request->record_ids);
        Actor::destroy($ids);
        return to_route('admin.actors.index')->with('success','data deleted successfully');
    }
}
