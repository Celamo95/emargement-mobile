@extends('layouts.base')

@section('title')
Modifier mon profil
@endsection

@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('profil.update') }}">
    @csrf

    <label>Nom :</label>
    <input type="text" name="name" value="{{ $user->name }}">
<br>
    <label>Prénom :</label>
    <input type="text" name="firstname" value="{{ $user->firstname }}">
<br>
    <label>Email :</label>
    <input type="email" name="email" value="{{ $user->email }}">
<br>
    <button type="submit">Enregistrer</button>
</form>

@endsection