<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grave extends Model 
{

    protected $table = 'graves';
    public $timestamps = true;
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function rows()
    {
        return $this->belongsTo('Row', 'row_id');
    }

}