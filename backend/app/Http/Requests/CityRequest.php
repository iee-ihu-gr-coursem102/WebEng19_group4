<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required_without_all:lat,lon,radius|max:120',
            'lat' => 'required_without_all:name|numeric',
            'lon' => 'required_without_all:name|numeric',
            'radius' => 'required_without_all:name|numeric'
        ];
    }
}
