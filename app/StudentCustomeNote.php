<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCustomeNote extends Model
{
    public function facilityType()
    {
        return $this->belongsTo(FacilityType::class,'facility_type','id');
    }
}
