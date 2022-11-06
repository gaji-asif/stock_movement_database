<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntStudent extends Model
{
    // use HasFactory;
    protected $table = 'int_students';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(DtbUser::class, 'user_id', 'id');
    }
    public function agent()
    {
        return $this->belongsTo(DtbUser::class, 'agent_id', 'id');
    }
    public function administrator()
    {
        return $this->belongsTo(DtbUser::class, 'administrator_id', 'id');
    }
    public function studentNote()
    {
        return $this->belongsTo(StudentNote::class, 'id', 'student_id');
    }
    public function studentCustomNote()
    {
        return $this->belongsTo(StudentCustomeNote::class, 'id', 'student_id');
    }
}
