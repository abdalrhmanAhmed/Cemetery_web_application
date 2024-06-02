<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Notification extends Model 
{
    use HasTranslations;

    protected $table = 'notifications';

    public $timestamps = true;
    protected $guarded = [];
    public $translatable = ['title'];
    use SoftDeletes;



    protected $dates = ['deleted_at'];

}