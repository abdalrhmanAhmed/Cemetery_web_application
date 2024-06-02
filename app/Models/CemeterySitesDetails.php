<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CemeterySitesDetails extends Model 
{

    protected $table = 'cemetery_sites_details';
    public $timestamps = true;

    protected $guarded = [];
    public $translatable = ['name'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}