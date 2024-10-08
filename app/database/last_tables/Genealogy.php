<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Genealogy extends Model 
{
    use HasTranslations;

    protected $table = 'genealogy';
    public $timestamps = true;
    protected $guarded = [];
    public $translatable = ['name'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}