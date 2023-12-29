<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class City extends Model 
{
    use HasTranslations;

    protected $table = 'cities';
    public $timestamps = true;
    protected $guarded = [];
    public $translatable = ['name'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}