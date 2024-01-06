<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('dashboard.password.edit',compact('user'));
    }
    public function update(PasswordRequest $request)
    {
        auth()->user()->update($request->validated());
        return redirect()->route('admin.password.edit')->with('success', 'Profile updated successfully!');
    }

}
