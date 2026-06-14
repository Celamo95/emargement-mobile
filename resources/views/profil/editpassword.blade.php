@extends('layouts.base')

@section('title')
Changer mon mot de passe
@endsection

@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('profil.passwordUpdate') }}">
    @csrf

    <label>Nouveau mot de passe :</label>
    <input type="password" name="password">

    <label>Confirmer le mot de passe :</label>
    <input type="password" name="password_confirmation">

    <button type="submit">Enregistrer</button>
</form>

@endsection