<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentNote extends Model
{
    public function addedBy()
    {
        return $this->belongsTo(DtbUser::class, 'added_by','id');
    }
}
