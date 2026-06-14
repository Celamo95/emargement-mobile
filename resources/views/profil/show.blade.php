@extends('layouts.base')

@section('title')
Mon profil
@endsection

@section('content')

<p>Nom : {{ $user->name }}</p>
<p>Prénom : {{ $user->firstname }}</p>
<p>Email : {{ $user->email }}</p>
<p>Formation : {{ $user->formation->name ?? 'N/A' }}</p>

<a href="{{ route('profil.edit') }}">Modifier mon profil</a>
<a href="{{ route('profil.passwordEdit') }}">Changer mon mot de passe</a>
@endsection