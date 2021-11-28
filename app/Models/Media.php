<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
    public $timestamps = false;

    protected $guarded = [];

    /**
     *
     */
    public function mediable()
    {
        return $this->morphTo();
    }
}
