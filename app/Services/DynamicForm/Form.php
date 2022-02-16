<?php

namespace App\Services\DynamicForm;

use App\Models\DynamicFormQuestion;
use App\Models\DynamicForm;
use App\Models\DynamicFormAnswer;
use App\Traits\ApiResponser;

class Form
{
    use ApiResponser;
    function submit($data)
    {

        $data["user_id"] = auth()->user()->id;

        $form = DynamicForm::create($data);

        $form->questions()->createMany($data["questions"]);

        return $form;
    }

    function update($form = null, $data)
    {
        if($form->check_answer) {
           return abort(400,"the form have already answers,you cannot update");
        }
        $form->update($data);
        
        $form->questions()->delete();

        $form->questions()->createMany($data["questions"]);

        return $form;
    }

    function answerSubmit($data) {

        foreach($data["answers"] as $answer) {

            DynamicFormAnswer::create([
                "user_id" => auth()->user()->id,
                "question_id" => $answer["question_id"],
                "answer" => $answer["answer"] ?? "",
                "option_answers" => $answer["option_answers"] ?? []
            ]);
        }

        return true;
    }
}
