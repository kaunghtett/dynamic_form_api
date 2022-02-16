<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicForm extends Model
{
    use HasFactory;

    protected $table = "dynamic_forms";
    protected $with = ['questions']; //N+1 solved

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "status"
    ];

    public function scopeActive($query)
    {
        return $query->where('status', "active");
    }

    public function scopeInactive($query) {
        return $query->where('status', "inactive");
    }

    public function questions() {
        return $this->hasMany(DynamicFormQuestion::class,'id');
    }
}
