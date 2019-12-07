<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ApiController extends Controller
{
    private $apiKey = '7e0f958cd147286c8c3af0640e4d9bf6';
    public function cities(CityRequest $request)
    {
        $validatedData = $request->validated();

        if(isset($validatedData['name']) && !empty($validatedData['name']))
        {
           echo $this->apiCall('weather',array('q'=>$validatedData['name']));
        }
        else
        {
            echo $this->apiCall('weather',array('lat'=>$validatedData['lat'],'lon'=>$validatedData['lon']));
        }
    }

    /**
     * Calculates a box of coordinates from lat,lon and radius
     */
    private function calculateBbox($lat,$lon,$radius)
    {
        $earhRadius = 6371.01;
        $radius = $radius/ $earhRadius; 
        $minLat = $lat - $radius;
        $maxLat = $lat + $radius;
        $deltaLon = asin(sin($radius) / cos($lat));
        $minLon = $lon - $deltaLon;
        $maxLon = $lon + $deltaLon;

        $zoom = 10; //WeatherMap needs it 
        return $minLon.','.$minLat.','.$maxLon.','.$maxLat.','.$zoom;
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
