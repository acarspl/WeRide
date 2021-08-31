<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetEventsWithinBoundsRequest extends FormRequest
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
            'latSW'=> 'required|numeric',
            'lngSW'=>'required|numeric',
            'latNE'=>'required|numeric',
            'lngNE'=>'required|numeric',
        ];
    }
}
