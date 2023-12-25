<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model 
{

    protected $table = 'blocks';
    public $timestamps = true;
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cemeteries()
    {
        return $this->belongsTo('Cemetery', 'cemetery_id');
    }

}