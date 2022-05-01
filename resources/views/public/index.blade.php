@extends('public.layout')

@section('content')
    Tartalom

    <hr>

    <a href="{{ route('login') }}">
        Belépés
    </a>
    <a href="{{ route('register') }}">
        Regisztráció
    </a>

@endsection
