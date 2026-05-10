@extends('layouts.base')

@section('title')
Aujourd'hui
@endsection

@section('content')

<div class="logo">
    <img src="{{asset('images/Groupe-GEFOR.png')}}" alt="Logo du groupe GEFOR">
</div>

<div>
    <h3>Mes cours</h3>
    <p>Vendredi 29 septembre 2026</p>
</div>

<div class="morning">
    <h4>Matin : 9h - 12h30</h4>
    <p>Mathématiques pour l'informatique</p>
    <p>Mme BJHIGG Mhdhfjfb</p>
    <button type="submit"><a href="{{route('sign')}}">Signer</a></button>
</div>

<div class="afternoon">
    <h4>Après-midi : 13h30 - 17h00</h4>
    <p>Culture générale et Expression</p>
    <p>Mme kgtjngghb phfhfh</p>
    <button type="submit"><a href="{{route('sign')}}">Signer</a></button>
</div>

<p><a href="{{route('login')}}">Retour page de cconnexion</a></p>

@endsection