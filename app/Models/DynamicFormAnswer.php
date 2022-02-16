<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicFormAnswer extends Model
{
    use HasFactory;
    protected $table = "dynamic_form_answers";

    protected $casts = [
        'option_answers' => 'array'
    ];

    protected $fillable = [
        "question_id",
        "answer",
        "option_answers",
        "user_id"
    ];

}
