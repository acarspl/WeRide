<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRideRequest extends FormRequest
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
            'start_location_lat'=>'required|numeric|min:-90|max:90',
            'start_location_lng' =>'required|numeric|min:-180|max:180',
            'end_location_lat'=>'nullable|numeric|min:-90|max:90',
            'end_location_lng'=>'nullable|numeric|min:-180|max:180',
            'estimated_effort'=> 'required|numeric|min:1|max:5',
            'route_link'=>'nullable|url',
            'distance'=>'required|numeric|min:0.1|max:5000',
            'elevation'=>'required|numeric|min:0|max:90000',
            'going_outside_website' => 'required|numeric|min:1',
            'max_users'=> 'required|numeric|min:2|max:5000',
            'speed_min'=> 'required|numeric|min:0.1|lte:speed_max',
            'speed_max'=> 'required|numeric|gte:speed_min|max:100',
            'signing_deadline'=>'required|date|before_or_equal:start_time',
            'description' => 'nullable|string|min:0|max:920',
            'additional_information' =>'nullable|string|min:0|max:276',
            'helmet_required' => 'boolean',
            'lights_required' => 'boolean',
        ];
    }
    public function messages()
    {
        return [
            'sport_type_id.min' => 'Select the type of sport',
            'start_location_lat.*' => 'Start Location must be selected',
            'signing_deadline.before_or_equal' => 'Signing deadline cannot be after the start time',
        ];
    }
}
