<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicFormQuestion extends Model
{
    use HasFactory;

    protected $table = "dynamic_form_questions";

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean'
    ];

    protected $fillable = [
        "form_id",
        "title",
        "type",
        "is_required",
        "options"
    ];
}
