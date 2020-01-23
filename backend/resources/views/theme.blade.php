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
                    <a href="{{ url("/setSkin?skin=mother") }}"><li class="menu-item @if ($data['skin'] == 'mother') selected @endif">Ελληνίδα Μάνα</li></a>
                    <a href="{{ url("/setSkin?skin=friend") }}"><li class="menu-item @if ($data['skin'] == 'friend') selected @endif">Κάφρος Φίλος/η</li></a>
                    <a href="{{ url("/setSkin?skin=bank") }}"><li class="menu-item @if ($data['skin'] == 'bank') selected @endif">Τράπεζα</li></a>
                    <a href="{{ url("/setSkin?skin=tv") }}"><li class="menu-item @if ($data['skin'] == 'tv') selected @endif">Greek TV</li></a>
                </ul>
            </div>
        </div>
    </div>
    @stop
