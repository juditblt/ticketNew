@extends('admin.layout')

@section('content')
    <h2>Hibajegy adatai</h2>

    Id: {{ $ticket->id }} <br>
    Felhasználó: {{ $ticket->user->name ?? "-nincs felhasználó-" }} <br>
    Kategória: {{ $ticket->category->name  ?? "-nincs kategória-" }} <br>
    Állapot: {{ $ticket->status }} <br>
    Prioritás: {{ $ticket->priority }} <br>
    Leírás: {{ $ticket->description }} <br>
@endsection
