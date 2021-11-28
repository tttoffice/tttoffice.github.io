<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded=[];

    public function closedBy()//supporter
    {
        return $this->hasone('App\User','id', 'closedBy_id');
    }

    public function user()//employee
    {
        return $this->hasone('App\User','id', 'user_id');
    }


    public function users()//replies between support and employee
    {
        return $this->belongsToMany('App\User')->WithPivot('reply','created_at');
    }



    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }



        /**
     * Get all media of ticket.
     */
    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


}
