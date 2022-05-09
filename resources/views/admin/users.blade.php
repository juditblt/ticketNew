@extends('admin.layout')

@section('content')
    <ul>
    @forelse($users as $user)
        <li>
            Név: {{ $user->name }} <br>
            E-mail: {{ $user->email }} <br>
            Szerep: {{ $user->role }} <br>
            <form action="{{ route('admin.users.destroy') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="submit" value="Törlés">
            </form>
            <form action="{{ route('admin.users.promote') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="submit" value="Adminná előléptetés">
            </form>
        </li>
    @empty
        <li>Hiba</li>
    @endforelse
    </ul>

@endsection
