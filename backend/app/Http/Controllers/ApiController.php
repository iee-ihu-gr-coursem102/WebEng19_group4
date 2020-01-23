<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ApiController extends Controller
{
    /**
    * Search by city name or lat ,lon and radius
    */
    public function cities(CityRequest $request)
    {
        $validatedData = $request->validated();

        $result = "[]";
        if(isset($validatedData['name']) && !empty($validatedData['name']))
        {
            $city = City::getCityByName($validatedData['name']);
            $result = "[]";
            if(!empty($result))
                $result = $city->apiCall('weather',array('id'=>$city->id,'units'=>'metric'));
        }
        else
        {
            $cities = City::getCitiesInRadius($validatedData['lat'],$validatedData['lon'],$validatedData['radius']);

            $cityIds = array();
            foreach($cities as $city)
                $cityIds[] = $city->id;

            $result = $city->apiCall('group',array('id'=>implode(",",$cityIds),'units'=>'metric'));
        }

        echo $result;
    }

    /**
    * Weather by id
    */
    public function weather($cityId)
    {
        //If city id doesn't exist throw 404
        $city = City::findOrFail((int)$cityId);
        echo $city->apiCall('weather',array('id'=>$city->id));
    }

    /**
     * Forecast by id
     */
    public function forecast($cityId,$cnt = 16)
    {
        $city = City::findOrFail((int)$cityId);
        echo $city->apiCall('forecast',array('id'=>$city->id,'cnt'=>$cnt));
    }
}
