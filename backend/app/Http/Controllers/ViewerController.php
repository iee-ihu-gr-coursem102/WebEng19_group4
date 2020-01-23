<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Punchlines;

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
        if(empty($city))
            session(['locationId' => -1]);
        else
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
        if($data['city'] == -1)
        {
            $data['weather'] = array();
            $data['forecast']= array();
        }
        else
        {
            $data['weather'] = City::find($data['city']);
            $data['weather'] = $data['weather']->apiCall('weather',array('id'=>$data['city'],'units'=>'metric'));
            $data['weather']= json_decode($data['weather'],true);
            $data['text'] = Punchlines::getPunchLine($data['weather']['main']['temp'],'text');
            $temp = explode(" ",$data['text']);
            $data['last'] = $temp[count($temp)-1];
            unset($temp[count($temp)-1]);
            $data['text'] = implode(" ",$temp);
            $data['sub'] = Punchlines::getPunchLine($data['weather']['main']['temp'],'sub');
            $data['forecast'] = City::findOrFail($data['city'])->apiCall('forecast',array('id'=>$data['city'],'cnt'=>16,'units'=>'metric'));
            $data['forecast']= json_decode($data['forecast'],true);
            $data['small_1'] = Punchlines::getPunchLine($data['forecast']['list'][5]['main']['temp'],'small');
            $data['small_2'] = Punchlines::getPunchLine($data['forecast']['list'][10]['main']['temp'],'small');
            $data['small_3'] = Punchlines::getPunchLine($data['forecast']['list'][15]['main']['temp'],'small');
        }

        return view('single', compact('data'));
    }

    public function multiple()
    {
        $data = array();
        $data['city'] = session('locationId', 734077);
        $data['days'] = array('Δευτέρα', 'Τρίτη', 'Τετάρτη', 'Πέμπτη', 'Παρασκευή', 'Σάββατο', 'Κυριακή');

        $data['forecast'] = City::find($data['city']);
        if(empty($data['forecast']))
        {
            session(['locationId' => 734077]);
            $data['city'] = 734077;
            $data['forecast'] = City::find(734077);
        }

        $data['forecast'] = $data['forecast']->apiCall('forecast',array('id'=>$data['city'],'cnt'=>16,'units'=>'metric'));
        $data['forecast']= json_decode($data['forecast'],true);
        return view('multiple', compact('data'));
    }
}
