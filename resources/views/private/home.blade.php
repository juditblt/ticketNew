@extends('private.layout')

@section('content')

    <hr>

    <h2>Hibajegyeid</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Prioritás</th>
            <th>Kategória</th>
            <th>Leírás</th>
            <th>Bejelentés ideje</th>
        </tr>
        @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->priority }}</td>
                <td>{{ $ticket->category->name ?? "-nem létező-"}}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->created_at }}</td>


            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Nincsenek ticketei!
                </td>
            </tr>
        @endforelse
    </table>

    <hr>
    <h2>Hibajegy létrehozása</h2>
    <form action="{{ route('private.ticket.store') }}" method="post">
        @csrf

        Kategória
        <select name="ticket_category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id  }}">{{$category->name}}</option>
            @endforeach
        </select>
        <br>
        Prioritás
        <input type="number" min="0" max="10" name="ticket_prio"/>
        <br>
        Leírás
        <textarea name="ticket_description" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" value="Létrehozás">
    </form>

@endsection

