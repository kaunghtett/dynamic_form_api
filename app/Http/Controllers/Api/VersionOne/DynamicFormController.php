<?php

namespace App\Http\Controllers\Api\VersionOne;

use App\Events\FormSubmitEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormSubmitRequest;
use App\Http\Resources\v1\DynamicFormResource;
use App\Models\DynamicForm;
use App\Models\DynamicFormQuestion;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\DynamicForm\Form;
use App\Http\Requests\AnswerSubmitRequest;

class DynamicFormController extends Controller
{
    use ApiResponser;
    //

    public function formSubmit(FormSubmitRequest $request)
    {

        try {

            DB::beginTransaction();

            $form = (new Form())->submit($request->all());

            event(new FormSubmitEvent($form,auth()->user()));

            DB::commit();

            $form->load('questions', 'questions.answers');

            return $this->successResponse(new DynamicFormResource($form), "success");
        } catch (Exception $e) {
            DB::rollBack();

            return $this->apiExceptionResponse($e);
        }
    }


    public function formUpdate(FormSubmitRequest $request, $id)
    {
        try {

            $form = DynamicForm::with(['questions', 'questions.answers'])->findorFail($id);

            (new Form())->update($form, $request->all());

            event(new FormSubmitEvent($form,auth()->user()));


            return $this->successResponse(new DynamicFormResource($form), "update success");
        } catch (Exception $e) {
            return $this->apiExceptionResponse($e);
        }
    }



    public function answerSubmit(AnswerSubmitRequest $request)
    {

        try {

            $form = DynamicForm::with(['questions', 'questions.answers'])->findorFail($request->form_id);

            (new Form())->answerSubmit($request->all());

            $form->load('questions', 'questions.answers');

            return $this->successResponse(new DynamicFormResource($form), "answer submit");
        } catch (Exception $e) {
            return $this->apiExceptionResponse($e);
        }
    }






    public function getForm($id)
    {
        try {

            $form = DynamicForm::with(['questions', 'questions.answers'])->findorFail($id);
            return $this->successResponse(new DynamicFormResource($form), "get Form");
        } catch (Exception $e) {
            return $this->apiExceptionResponse($e);
        }
    }

    public function getAllForms()
    {
        try {
            $forms = DynamicForm::with(['questions', 'questions.answers'])->get();
            return $this->successResponse(DynamicFormResource::collection($forms), "success");
        } catch (Exception $e) {
            return $this->apiExceptionResponse($e);
        }
    }

}
