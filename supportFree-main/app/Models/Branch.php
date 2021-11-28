<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Branch extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded=[];

    public $translatedAttributes = ['title','content'];

    public function users()
    {
        return $this->hasMany('App\User');
    }



    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
