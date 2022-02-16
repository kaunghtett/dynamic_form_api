<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicForm extends Model
{
    use HasFactory;

    protected $table = "dynamic_forms";
    protected $with = ['questions','questions.answers']; //N+1 solved

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "status"
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query) {
        return $query->where('status', 'inactive');
    }

    public function questions() {
        return $this->hasMany(DynamicFormQuestion::class,'form_id');
    }

    public function getCheckAnswerAttribute() {
        
        foreach($this->questions as $question) {
            if($question->answers->count() > 0) {
                return true;
            }
        }

        return false;
    } 
}
