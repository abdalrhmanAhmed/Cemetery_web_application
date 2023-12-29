<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Dead extends Model 
{
    use HasTranslations;

    protected $table = 'deceased';
    public $timestamps = true;
    protected $guarded = [];

    public $translatable = [
        'name',
        'father',
        'grand_father',
        'great_grand_father'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function religions()
    {
        return $this->belongsTo(Religion::class, 'relagen_id');
    }

    public function nationalities()
    {
        return $this->belongsTo(Nationality::class, 'national_id');
    }

    public function ganders()
    {
        return $this->belongsTo(Gander::class, 'gander_id');
    }

    public function genealogy()
    {
        return $this->belongsTo(Genealogy::class, 'genealogy_id');
    }

}