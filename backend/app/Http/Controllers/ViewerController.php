<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class ViewerController extends Controller
{
    public function index()
    {        
        $data = array();
        return view('welcome', compact('data'));
    }

    public function setSkin(Request $request)
    {
        $skin = $request->input('skin');
        session(['skin' => $skin]);

        return redirect('theme');
    }

    public function setLocation(Request $request)
    {
        $city = $request->input('city');
        $city = City::getCityByName($city);
        session(['locationId' => $city->id]);

        return redirect('single');
    }

    public function theme()
    {
        $data = array();
        $data['skin'] = session('skin', 'mother');
        return view('theme', compact('data'));
    }

    public function single()
    {
        $data = array();
        $data['city'] = session('locationId', 734077);
        $data['weather'] = City::findOrFail($data['city'])->apiCall('weather',array('id'=>$data['city'],'units'=>'metric'));
        $data['weather']= json_decode($data['weather'],true);
        $data['forecast'] = City::findOrFail($data['city'])->apiCall('forecast',array('id'=>$data['city'],'cnt'=>3,'units'=>'metric'));
        $data['forecast']= json_decode($data['forecast'],true);
        return view('single', compact('data'));
    }

    public function multiple()
    {
        $data = array();
        $data['city'] = session('locationId', 734077);
        $data['days'] = array('Δευτέρα', 'Τρίτη', 'Τετάρτη', 'Πέμπτη', 'Παρασκευή', 'Σάββατο', 'Κυριακή');

        $data['forecast'] = City::findOrFail($data['city'])->apiCall('forecast',array('id'=>$data['city'],'cnt'=>16,'units'=>'metric'));
        $data['forecast']= json_decode($data['forecast'],true);
        return view('multiple', compact('data'));
    }
}
