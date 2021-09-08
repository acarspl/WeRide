<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
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
            'name'=>'required|string|min:4|max:200',
            'sport_type_id'=>'required|numeric|min:1|max:99',
            'start_time' =>'required|date|after:yesterday',
            'end_time' =>'required|date|after_or_equal:start_time',
            'start_location_lat'=>'required|numeric|min:-90|max:90',
            'start_location_lng' =>'required|numeric|min:-180|max:180',
            'end_location_lat'=>'nullable|numeric|min:-90|max:90',
            'end_location_lng'=>'nullable|numeric|min:-180|max:180',
            'route_link'=>'nullable|url',
            'distance'=>'required|numeric|min:0.1|max:5000',
            'elevation'=>'required|numeric|min:0|max:90000',
            'max_users'=> 'required|numeric|min:2|max:5000',
            'signing_deadline'=>'required|date|before_or_equal:start_time',
            'description' => 'nullable|string|min:0|max:920',
            'additional_information' =>'nullable|string|min:0|max:276',
            'price'=>'required|numeric|min:0',
            'requirements' =>'nullable|string|min:0|max:276',
        ];
    }
    public function messages()
    {
        return [
            'sport_type_id.min' => 'Select the type of sport',
            'start_location_lat.*' => 'Start Location must be selected',
            'end_time.after_or_equal' => 'Race ending time cannot be before the start time',
            'signing_deadline.before_or_equal' => 'Signing deadline cannot be after the start time',
        ];
    }
}
