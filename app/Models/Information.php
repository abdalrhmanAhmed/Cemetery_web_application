<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model 
{

    protected $table = 'informations';
    public $timestamps = true;
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function deceased()
    {
        return $this->belongsTo('Dead', 'deceased_id');
    }

    public function guardians()
    {
        return $this->belongsTo('Guardian', 'guardian_id');
    }

    public function hospitals()
    {
        return $this->belongsTo('Hospital', 'hospital_id');
    }

    public function graves()
    {
        return $this->belongsTo('Grave', 'grave_id');
    }

}