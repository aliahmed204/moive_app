<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name',['super_admin','admin','user'])->get();
        return view('dashboard.admins.index',compact('roles'));
    }
    public function data()
    {
        $admins = User::whereHasRole('admin')
            ->whenRoleId(request()->role_id);

        return DataTables::of($admins)
            ->addColumn('record_select','dashboard.admins.data_table.record_select')
            ->addColumn('roles', function(User $admin) {
                return view('dashboard.admins.data_table.roles',compact('admin'));
            })
            ->editColumn('created_at', function (User $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('actions','dashboard.admins.data_table.actions')
            ->rawColumns(['record_select','roles','actions'])
            ->toJson();
    }

    public function create()
    {
        $roles = Role::whereNotIn('name',['super_admin','admin','user'])->get();
        return view('dashboard.admins.create',compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $admin = User::create($request->validated());
        $admin->addRoles(['admin',$request->role_id]);

        session()->flash('success','data created successfully');
        return to_route('admin.admins.index');
    }

    public function edit(User $admin)
    {
        $roles = Role::whereNotIn('name',['super_admin','admin','user'])->get();
        $admin_roles = $admin->roles()->pluck('id')->toArray();
        return view('dashboard.admins.edit',compact('admin','roles','admin_roles'));
    }

    public function update(AdminRequest $request ,User $admin)
    {
        $admin->update($request->validated());
        $admin->syncRoles(['admin',$request->role_id]);
        return to_route('admin.admins.index')->with('success','data updated successfully');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return to_route('admin.admins.index')->with('success','data deleted successfully');
    }
    public function bulk_delete(Request $request)
    {
        $ids = json_decode($request->record_ids);
        User::destroy($ids);
        return to_route('admin.admins.index')->with('success','data deleted successfully');
    }

}
