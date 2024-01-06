<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('permission:roles_read')->only('index');
        $this->middleware('permission:roles_create')->only(['create' , 'store']);
        $this->middleware('permission:roles_update')->only(['edit','update']);
        $this->middleware('permission:roles_delete')->only('destroy');
    }*/

    public function index()
    {

        return view('dashboard.roles.index');
    }
    public function data()
    {
        $role = Role::whereNotIn('name',['super_admin','admin','user'])
            ->withCount(['users']);

        return DataTables::of($role)
            ->addColumn('record_select','dashboard.roles.data_table.record_select')
            ->editColumn('created_at', function (Role $role) {
                return $role->created_at->format('Y-m-d');
            })
            ->addColumn('actions','dashboard.roles.data_table.actions')
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

    public function create()
    {
        return view('dashboard.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->safe()->only('name'));
        $role->givePermissions($request->permissions);

        session()->flash('success','data created successfully');
        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('dashboard.roles.edit',compact('role'));
    }

    public function update(RoleRequest $request ,Role $role)
    {
        $role->update($request->safe()->only('name'));
        $role->syncPermissions($request->permissions);
        return to_route('admin.roles.index')->with('success','data updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return to_route('admin.roles.index')->with('success','data deleted successfully');
    }
    public function bulk_delete(Request $request)
    {
        $ids = json_decode($request->record_ids);
        Role::destroy($ids);
        return to_route('admin.roles.index')->with('success','data deleted successfully');
    }

}
