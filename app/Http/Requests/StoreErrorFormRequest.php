<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreErrorFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "ipOrOpNumber" => "required | min:4 | max:25",
            "diagnosis" => "required  | min:4",
            "gender" => "required",
            "date" => "required",
            "time" => "required",
            "age" => "required",
            "locationOfError" => "required",
            "specificLocation" => "required",
            "specifyLocationByUser" => "required",
            "incident" => "required",
            "typeOfError" => "required",
            "outcome" => "required",
            "possibleFactors" => "required",
            "preventability" => "required",
            "suggestedPreventiveMeasures" => "required",
            "occupation" => "required",
            "email" => "email | nullable",
            "user_id" => "nullable",
        ];
    }
}
