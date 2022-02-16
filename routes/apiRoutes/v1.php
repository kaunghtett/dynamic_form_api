<?php

use App\Http\Controllers\Api\VersionOne\DynamicFormController;

Route::middleware('auth:sanctum')->group( function() {
    Route::prefix('form')->group( function() {
        Route::post('/',[DynamicFormController::class,'formSubmit']);
    });
}); 

