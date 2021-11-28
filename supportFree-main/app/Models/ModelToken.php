<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelToken extends Model
{
    protected $table = "model_tokens";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model','model_id', 'token', 'device_id', 'device_type','lang', 'version',
    ];
}
