<?php

namespace App\Rules;

use App\Models\DynamicFormQuestion;
use App\Traits\ApiResponser;
use Illuminate\Contracts\Validation\Rule;

class ExistQuestion implements Rule
{
    use ApiResponser;
   
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
     
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //

        return DynamicFormQuestion::where('id',$value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
