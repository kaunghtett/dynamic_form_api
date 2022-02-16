<?php

namespace App\Http\Controllers\Api\VersionOne;

use App\Events\FormSubmitEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormSubmitRequest;
use App\Models\DynamicForm;
use App\Models\DynamicFormQuestion;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\DynamicForm\Form;

class DynamicFormController extends Controller
{
    use ApiResponser;
    //

    public function formSubmit(FormSubmitRequest $request) {

        try {

            DB::beginTransaction();

            $form = (new Form())->submit($request->all());

            event(new FormSubmitEvent($form,auth()->user()));
         
            DB::commit();


        }
         catch( Exception $e) {
            DB::rollBack();

            return $this->apiExceptionResponse($e);
         }

    }

  
}
