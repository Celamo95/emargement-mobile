@extends('layouts.base')

@section('title')
Connexion
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')
<div class="logo">
    <img src="{{asset('images/Groupe-GEFOR.png')}}" alt="Logo du groupe GEFOR">
</div>
<div class="form">
    <form action="">
        <input type="text" id="identifiant" name="identifiant" placeholder="Identifiant">
        <input type="password" id="password" name="password" placeholder="Mot de passe">
        <button type="submit"><a href="{{route('home')}}">Connexion</a></button>
    </form>
</div>
@endsection