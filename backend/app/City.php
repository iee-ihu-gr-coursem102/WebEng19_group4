<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
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

        if(!empty($city))
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
}
