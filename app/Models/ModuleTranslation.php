<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','content'];
}
