<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cemetery extends Model 
{

    protected $table = 'cemeteries';
    public $timestamps = true;
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cities()
    {
        return $this->belongsTo('City', 'citiy_id');
    }

}