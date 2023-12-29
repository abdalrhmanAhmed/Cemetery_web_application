<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Grave extends Model 
{
    protected $table = 'graves';
    public $timestamps = true;
    protected $guarded = [];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function blocks()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

}