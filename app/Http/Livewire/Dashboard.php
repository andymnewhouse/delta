<?php

namespace App\Http\Livewire;

use App\Models\Point;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Dashboard extends Component
{
    public $lat = '41.6322';
    public $long = '-88.2120';
    public $saved = false;

    public $form = [
        'joint' => null,
        'muscle' => null,
    ];

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.guest')
            ->with([
                'jointPain' => $this->jointPain,
                'musclePain' => $this->musclePain,
                'todayTemp' => $this->todayTemp,
                'todayWeather' => $this->todayWeather,
                'yesterdayTemp' => $this->yesterdayTemp,
                'yesterdayWeather' => $this->yesterdayWeather,
            ]);
    }

    public function getJointPainProperty()
    {
        $jointPain = false;

        if(abs($this->todayTemp - $this->yesterdayTemp) > 20) {
            $jointPain = true;
        }

        if($this->todayWeather['id'] < 700 && $this->yesterdayWeather['id'] > 700) {
            $jointPain = true;
        }

        return $jointPain;
    }

    public function getMusclePainProperty()
    {
        $musclePain = false;

        if($this->todayTemp < 35) {
            $musclePain = true;
        }

        return $musclePain;
    }

    public function getTodayProperty()
    {
        return Http::get('https://api.openweathermap.org/data/2.5/onecall', [
            'lat' => $this->lat,
            'lon' => $this->long,
            'exclude' => 'hourly,minutely',
            'appid' => env('WEATHER_APP_ID'),
            'units' => 'imperial',
        ])->json();
    }

    public function getTodayTempProperty()
    {
        return $this->today['current']['temp'];
    }

    public function getTodayWeatherProperty()
    {
        return $this->today['current']['weather'][0];
    }

    public function getYesterdayProperty()
    {
        return Http::get('https://api.openweathermap.org/data/2.5/onecall/timemachine', [
            'lat' => $this->lat,
            'lon' => $this->long,
            'dt' => now()->subDay()->timestamp,
            'appid' => env('WEATHER_APP_ID'),
            'units' => 'imperial',
        ])->json();
    }

    public function getYesterdayTempProperty()
    {
        return $this->yesterday['current']['temp'];
    }

    public function getYesterdayWeatherProperty()
    {
        return $this->yesterday['current']['weather'][0];
    }

    public function save()
    {
        Point::create([
            'yesterday_temp' => $this->yesterdayTemp,
            'today_temp' => $this->todayTemp,
            'yesterday_weather' => $this->yesterdayWeather['main'],
            'today_weather' => $this->todayWeather['main'],
            'joint_pain' => $this->form['joint'],
            'muscle_pain' => $this->form['muscle'],
        ]);

        $this->saved = true;
    }
}
