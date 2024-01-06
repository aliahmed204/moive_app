<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('dashboard.profile.edit',compact('user'));
    }
    public function update(ProfileRequest $request)
    {
        $requestData = $request->validated();
        if($request->logo){
            if(auth()->user()->hasImage()){
                Storage::disk('local')->delete('public/uploads/users'.setting('image'));
            }
            $request->image->store('public/uploads/users');
            $requestData['image'] = $request->image->hashName();
        }
        auth()->user()->update($requestData);
        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');
    }


}
