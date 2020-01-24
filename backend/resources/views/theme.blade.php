@extends('layout')
@section('content')
    <div class="content menu-content">
        <div class="content-inner">
            <div class="image">
                <img src="{{ asset('assets/images/splash-image.png') }}" alt="logo big" />
            </div>
            <div class="title">
                <h1 class="secondary-color">μάθε τον καιρό</h1>
                <h1 class="subtitle main-color">από</h1>
            </div>
            <div class="menu-items">
                <ul class="list-unstyled menu-items-list">
                    <li class="menu-item @if ($data['skin'] == 'mother') selected @endif"><a href="{{ url("/setSkin?skin=mother") }}">Ελληνίδα Μάνα</a></li>
                    <li class="menu-item @if ($data['skin'] == 'friend') selected @endif"><a href="{{ url("/setSkin?skin=friend") }}">Κάφρος Φίλος/η</a></li>
                    <li class="menu-item @if ($data['skin'] == 'bank') selected @endif"><a href="{{ url("/setSkin?skin=bank") }}">Τράπεζα</a></li>
                    <li class="menu-item @if ($data['skin'] == 'tv') selected @endif"><a href="{{ url("/setSkin?skin=tv") }}">Greek TV</a></li>
                </ul>
            </div>
        </div>
    </div>
    @stop
