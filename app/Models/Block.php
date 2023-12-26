<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Block extends Model 
{

    use HasTranslations;

    protected $table = 'blocks';
    public $timestamps = true;
    protected $guarded = [];
    public $translatable = ['name'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cemeteries()
    {
        return $this->belongsTo(Cemetery::class, 'cemetery_id');
    }

}