@extends('admin.layout')

@section('content')

    <h2>Hibajegyek</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Prioritás</th>
            <th>Kategória</th>
            <th>Leírás</th>
            <th>Bejelentés ideje</th>
            <th></th>
        </tr>
        @forelse($tickets as $ticket)
            <tr>
                <td>
                    <a href="{{ route('admin.tickets.show', ['id'=> $ticket->id]) }}">
                    {{ $ticket->id }}
                    </a>
                </td>
                <td>{{ $ticket->priority }}</td>
                <td>{{ $ticket->category->name ?? "-nem létező-"}}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->created_at }}</td>
                <td>
                    <form action="{{ route('admin.tickets.destroy') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ticket->id }}">
                        <input type="submit" value="Törlés">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Nincsenek ticketei!
                </td>
            </tr>
        @endforelse
    </table>

    <h3>Törölt hibajegyek</h3>
    <table>
        <tr>
            <th>Id</th>
            <th>Kategória</th>
            <th>Leírás</th>
            <th></th>
        </tr>
        @forelse($tickets_trash as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->category->name ?? "-nem létező-"}}</td>
                <td>{{ $ticket->description }}</td>
                <td>
                    <form action="{{ route('admin.tickets.revert') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ticket->id }}">
                        <input type="submit" value="Visszaállít">
                    </form>
                    <form action="{{ route('admin.tickets.permanent') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ticket->id }}">
                        <input type="submit" value="Végleges törlés">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Nincsenek törölt hibajegyek!
                </td>
            </tr>
        @endforelse
    </table>


@endsection
