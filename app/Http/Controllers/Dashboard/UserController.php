<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index');
    }
    public function data()
    {
        $admins = User::where('type','user')->select();

        return DataTables::of($admins)
            ->addColumn('record_select','dashboard.users.data_table.record_select')
            ->editColumn('created_at', function (User $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('actions','dashboard.users.data_table.actions')
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());
        session()->flash('success','data created successfully');
        return to_route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(UserRequest $request ,User $user)
    {
        $user->update($request->validated());
        return to_route('admin.users.index')->with('success','data updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('admin.users.index')->with('success','data deleted successfully');
    }
    public function bulk_delete(Request $request)
    {
        $ids = json_decode($request->record_ids);
        User::destroy($ids);
        return to_route('admin.users.index')->with('success','data deleted successfully');
    }
}
