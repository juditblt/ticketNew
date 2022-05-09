<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket System</title>
</head>
<body>

<h1>Ticket rendszer - Admin</h1>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <input type="submit" value="Kilépés">
</form>

@if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
    <a href="{{ route('admin') }}">
        Admin Home
    </a>
@endif

@section('content')
    Admin oldal tartalma...
@show

</body>
</html>
