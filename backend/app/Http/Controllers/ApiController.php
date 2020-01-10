<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ApiController extends Controller
{
    private $apiKey = '7e0f958cd147286c8c3af0640e4d9bf6';

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
                $result = $this->apiCall('weather',array('id'=>$city->id));
        }
        else
        {
            $cities = City::getCitiesInRadius($validatedData['lat'],$validatedData['lon'],$validatedData['radius']);

            $cityIds = array();
            foreach($cities as $city)
                $cityIds[] = $city->id;

            $result = $this->apiCall('group',array('id'=>implode(",",$cityIds),'units'=>'metric'));
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
        echo $this->apiCall('weather',array('id'=>$city->id));
    }

    /**
     * Forecast by id
     */
    public function forecast($cityId,$cnt = 16)
    {
        $city = City::findOrFail((int)$cityId);
        echo $this->apiCall('forecast',array('id'=>$city->id,'cnt'=>$cnt));
    }

    /**
    * Does the api call to openweather and returns the result
    */
    private function apiCall($request,$parameters)
    {
        $parameters['APPID'] = $this->apiKey;
        $requestUrl = 'http://api.openweathermap.org/data/2.5/'.$request;

        $firstPramater = true;

        foreach($parameters as $parameter => $value)
            if($firstPramater)
            {
                $requestUrl .= '?'.$parameter.'='.$value;
                $firstPramater = false;
            }
            else
                $requestUrl .= '&'.$parameter.'='.$value;

        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_URL, $requestUrl);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        $result = curl_exec($cURL);
        curl_close($cURL);

        return $result;
    }
}
