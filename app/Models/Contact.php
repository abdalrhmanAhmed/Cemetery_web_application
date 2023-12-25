<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model 
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}