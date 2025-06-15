<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_code', 'subject_name'];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
