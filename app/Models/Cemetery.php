<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Cemetery extends Model 
{
    use HasTranslations;

    protected $table = 'cemeteries';
    public $timestamps = true;
    protected $guarded = [];
    public $translatable = ['name'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cities()
    {
        return $this->belongsTo(City::class, 'citiy_id');
    }

}