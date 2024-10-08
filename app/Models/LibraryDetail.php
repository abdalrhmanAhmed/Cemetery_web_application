<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryDetail extends Model 
{

    protected $table = 'librares_details';
    public $timestamps = true;
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}