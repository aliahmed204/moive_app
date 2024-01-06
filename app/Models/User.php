<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;


class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    protected $fillable = [
        'name', 'email', 'password',
        'image', 'type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'image_path',
    ];

    public function scopeWhenRoleId(Builder $builder, $roleId)
    {
        return $builder->when($roleId, function ($query) use ($roleId) {
            $query->whereHas('roles', function ($role) use ($roleId) {
                $role->where('id', $roleId);
            });
        });
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getImagePathAttribute(){
        if ($this->image){
            return Storage::url('uploads/users/'.'$user[image]');
        }

        return asset('dashboard/images/user.png');
    }

    /*Functions*/
    public function hasImage()
    {
        return $this->image != null;
    }



}
