<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'question_order', 'content',
        'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
