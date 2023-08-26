<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'code', 'nip', 'major_id', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {

        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                // 'image' => '/profile/default.png',

            ]);
        });
    }

    // Relationship between User & Profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

    // change default search by id to username for ex
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function major()
    {
        return $this->belongsTo(Carrera::class, 'major_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
