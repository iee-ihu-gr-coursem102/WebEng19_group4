<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';
    private $apiKey = '7e0f958cd147286c8c3af0640e4d9bf6';
    protected $fillable = [
        'name',
        'country',
        'lat',
        'lon'
    ];

    public static function getCityByName($name)
    {
        $city = City::where('name', 'like',$name.'%')
        ->select('*')
        ->limit(1)
        ->get();

        if(!$city->isEmpty())
            return $city[0];

        return array();
    }

    public static function getCitiesInRadius($lat,$lon,$radius)
    {
        $box = City::calculateBox($lat,$lon,$radius);

        $cities = City::where('lat','>=',$box['minLat'])
        ->where('lat','<=',$box['maxLat'])
        ->where('lon','>=',$box['minLon'])
        ->where('lon','<=',$box['maxLon'])
        ->limit(20) //Limit of free api
        ->get();

        return $cities;
    }

    /**
     * Calculates delta from lat,lon and given radius
     */
    private static function calculateBox($lat,$lon,$radius)
    {
        $earthRadius = 6371.01;  // earth's mean radius, km

        $result = array();

        $result['maxLat'] = $lat + rad2deg($radius/$earthRadius);
        $result['minLat'] = $lat - rad2deg($radius/$earthRadius);
        $result['maxLon'] = $lon + rad2deg(asin($radius/$earthRadius) / cos(deg2rad($lat)));
        $result['minLon'] = $lon - rad2deg(asin($radius/$earthRadius) / cos(deg2rad($lat)));

        return $result;
    }

    /**
     * Does the api call to openweather and returns the result
     */
    public function apiCall($request,$parameters)
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
