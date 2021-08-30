<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPreferencesRequest extends FormRequest
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

    public function rules()
    {
        return [
            'road_cycling'=>'nullable|string|in:on',
            'gravel'=>'nullable|string|in:on',
            'bike_touring'=>'nullable|string|in:on',
            'mtb' => 'nullable|string|in:on',
            'enduro' => 'nullable|string|in:on',
            'metric'=> 'nullable|string|in:on',
            'start_location_lat'=>'nullable|numeric|min:-90|max:90',
            'start_location_lng' =>'nullable|numeric|min:-180|max:180',
            'avatar' => 'nullable|mimes:jpg,jpeg|dimensions:min_width=32,max_width=256,ratio:1',
        ];
    }
}
