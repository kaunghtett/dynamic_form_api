<?php

use App\Http\Controllers\Api\VersionOne\DynamicFormController;

Route::middleware('auth:sanctum')->group( function() {
    Route::prefix('form')->group( function() {

        Route::post('/',[DynamicFormController::class,'formSubmit']);
        Route::get('/',[DynamicFormController::class, 'getAllForms']);
        Route::get('/{id}',[DynamicFormController::class,'getForm']);
      
        Route::post('/update/{id}',[DynamicFormController::class,'formUpdate']);
        Route::post('/answer',[DynamicFormController::class,'answerSubmit']);

    });
}); 

