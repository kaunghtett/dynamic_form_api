<?php

namespace App\Http\Requests;

use App\Rules\ExistQuestion;
use Illuminate\Foundation\Http\FormRequest;

class AnswerSubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answers' => 'required|array',
            'form_id' => 'required',
            'answers.*.question_id' => ['required', new ExistQuestion]
        ];
    }
}
