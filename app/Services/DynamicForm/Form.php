<?php

namespace App\Services\DynamicForm;
use App\Models\DynamicFormQuestion;
use App\Models\DynamicForm;

class Form {

    function submit($data) {
        $data["user_id"] = auth()->user()->id;
        $form = DynamicForm::create($data);

        foreach($data["questions"] as $question) {
            $this->storeQuestion($question,$form->id);
        }

        return $form;
    }
    

    protected static function storeQuestion($question,$formId) {
       
        $data  =  DynamicFormQuestion::create([
            "form_id" => $formId,
            "title" => $question->title ?? "",
            "type" => $question->type ?? "",
            "is_required" => (boolean) $question["is_required"],
            "options" => $question["options"]
        ]);

        $data->save();
    }
}