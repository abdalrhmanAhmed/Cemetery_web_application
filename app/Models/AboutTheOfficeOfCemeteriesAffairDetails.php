<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AboutTheOfficeOfCemeteriesAffairDetails extends Model 
{
    use HasTranslations;

    protected $table = 'about_the_office_of_cemeteries_affair_details';
    public $timestamps = true;
    protected $guarded = [];
    public $translatable = ['name'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}