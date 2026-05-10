@extends('layouts.base')

@section('title')
Signature
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@push('scripts')
@vite('resources/js/signature.js')
@endpush

@section('content')
<div class="logo">
    <img src="{{asset('images/Groupe-GEFOR.png')}}" alt="Logo du groupe GEFOR">
</div>
<div>
    <p>Vendredi 29 septembre 2026</p>
    <p>Mathématiques pour l'informatique</p>
    <p>9h - 12h30</p>

    <div class="sign">
        <label for="sign">Votre signature</label>
        <canvas id="signature-pad"></canvas>
    </div>

    <button id="save" type="submit">Valider</button>
    <button id="clear" type="submit">Effacer</button>
</div>
<p><a href="{{route('home')}}">Retour page accueil</a></p>
@endsection