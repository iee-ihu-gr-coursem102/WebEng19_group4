@extends('layout')
@section('content')
    <div class="content forecast-multiple-content">
        <div class="content-inner justify-content-between">
            <div class="search-section">
                <form action="{{ url('/setLocation') }}" method="GET">
                    <input type="text" name="city" class="search-input" placeholder="Πόλη, χωριό, περιοχή ..." />
                </form>

                <button class="search-btn"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg></button>
            </div>
            <div class="weekly-forecast">
                <h1 class="title">Αναλυτική Πρόβλεψη Καιρού <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="temperature-low" class="svg-inline--fa fa-temperature-low fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 0c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm0 128c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm-160-16C256 50.1 205.9 0 144 0S32 50.1 32 112v166.5C12.3 303.2 0 334 0 368c0 79.5 64.5 144 144 144s144-64.5 144-144c0-34-12.3-64.9-32-89.5V112zM144 448c-44.1 0-80-35.9-80-80 0-25.5 12.2-48.9 32-63.8V112c0-26.5 21.5-48 48-48s48 21.5 48 48v192.2c19.8 14.8 32 38.3 32 63.8 0 44.1-35.9 80-80 80zm16-125.1V304c0-8.8-7.2-16-16-16s-16 7.2-16 16v18.9c-18.6 6.6-32 24.2-32 45.1 0 26.5 21.5 48 48 48s48-21.5 48-48c0-20.9-13.4-38.5-32-45.1z"></path></svg></span></h1>

                <div class="forecasts-list">
                    @foreach ($data['forecast']['list'] as $weather)
                        <div class="forecast-item">
                            <div class="day">{{ $data['days'][date('N', strtotime($weather['dt_txt']))-1] }} {{ date('H:i', strtotime($weather['dt_txt'])) }}</div>
                            <div class="temprature"><span> {{ $weather['main']['temp'] }}</span>°</div>
                            <div class="forecast">
                                <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" alt="forecast-icon" />
                                <p class="text">{{ App\Punchlines::getPunchLine($weather['main']['temp'],'small') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

   @stop
