<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laratrust\Traits\LaratrustUserTrait;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    use HasApiTokens, Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','lastName','email', 'password','image','project_id','branch_id'
    ];


    public function tickets()
    {
        return $this->belongsToMany('App\Models\Ticket')->WithPivot('reply');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }



    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }



    //to call it on view like users.index
    //appends getImagePathAttribute() on down
    protected $appends=['image_path'];

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

    //access firstname by getFirstNameAttribute builtIn to convert first key of word to upper case
     public function getFirstNameAttribute($value)
     {
        return ucfirst($value);
     }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }
    //that access image_path by getImagePathAttribute() builtIn
    //ana 3mlt al7rka de bld ma3od akrr url fil view
    public function getImagePathAttribute()
    {
        return asset('uploads/users_images/'.$this->image);
    }
}
