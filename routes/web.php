<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $lat = '41.6322';
    $long = '-88.2120';

    $yesterday = Http::get('https://api.openweathermap.org/data/2.5/onecall/timemachine', [
        'lat' => $lat,
        'lon' => $long,
        'dt' => now()->subDay()->timestamp,
        'appid' => env('WEATHER_APP_ID'),
        'units' => 'imperial',
    ])->json();

    $today = Http::get('https://api.openweathermap.org/data/2.5/onecall', [
        'lat' => $lat,
        'lon' => $long,
        'exclude' => 'hourly,minutely',
        'appid' => env('WEATHER_APP_ID'),
        'units' => 'imperial',
    ])->json();

    $yesterdayTemp = $yesterday['current']['temp'];
    $yesterdayWeather = $yesterday['current']['weather'][0];
    $todayTemp = $today['current']['temp'];
    $todayWeather = $today['current']['weather'][0];
    $jointPain = false;
    $musclePain = false;

    if(abs($todayTemp - $yesterdayTemp) > 20) {
        $jointPain = true;
    }

    if($todayWeather['id'] < 700 && $yesterdayWeather['id'] > 700) {
        $jointPain = true;
    }

    if($todayTemp < 35) {
        $musclePain = true;
    }

    return view('dashboard', compact('yesterdayTemp', 'yesterdayWeather', 'todayTemp', 'todayWeather', 'jointPain', 'musclePain'));
});

// require __DIR__.'/auth.php';
