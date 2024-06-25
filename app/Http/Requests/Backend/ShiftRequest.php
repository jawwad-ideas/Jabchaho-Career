<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
            'name'                  => 'required|max:100',
            'from'                  => 'required|in:' . implode(',', array_keys(config('constants.time_slots'))),  
            'to'                    => 'required|in:' . implode(',', array_keys(config('constants.time_slots'))),  
            'is_enabled'            => 'required|in:' . implode(',', array_keys(config('constants.boolean_options'))),  
        ];
    }



     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    { 
        return [
            
            'name.required'                    => 'The Name field is required!',
            'name.max'                         => 'The Name must not be greater than :max characters.!',
            'from.required'                    => 'The From field is required!',
            'from.in'                          => 'Invalid From field!',
            'to.required'                      => 'The To field is required!',
            'to.in'                            => 'Invalid To field!',
            'is_enabled.required'              => 'Please select Enable Option?',
            'is_enabled.in'                    => 'Invalid Enable Option? !',



        ];
    }
    
    
}
