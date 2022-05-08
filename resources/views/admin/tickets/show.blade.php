@extends('admin.layout')

@section('content')
    <h2>Hibajegy adatai</h2>

    Id: {{ $ticket->id }} <br>
    Felhasználó:
    {{ $ticket->user->name ?? "-nincs felhasználó-" }}
    <a href="mailto: {{ $ticket->user->email ?? "-" }}">
        {{ $ticket->user->email ?? "-" }}
    </a>
    <br>
    Kategória: {{ $ticket->category->name  ?? "-nincs kategória-" }} <br>

    Állapot:
    @switch($ticket->status)
        @case("received")
        Beérkezett
        @break
        @case("working")
        Folyamatban
        @break
        @case("solved")
        Kész
        @break
    @endswitch

    @if($ticket->status != 'received')
        <a href="{{ route('admin.tickets.status', ['id'=>$ticket->id, 'status'=>'received']) }}">
            Fogadott
        </a>
    @endif
    @if($ticket->status != 'working')
        <a href="{{ route('admin.tickets.status', ['id'=>$ticket->id, 'status'=>'working']) }}">
            Folyamatban
        </a>
    @endif
    @if($ticket->status != 'solved')
        <a href="{{ route('admin.tickets.status', ['id'=>$ticket->id, 'status'=>'solved']) }}">
            Kész
        </a>
    @endif
    <br>

    Prioritás: {{ $ticket->priority }} <br>
    Leírás: {{ $ticket->description }} <br>
@endsection
