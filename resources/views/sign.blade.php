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
<div class="nativephp-safe-area">
    <div class="logo">
        <img src="{{asset('images/Groupe-GEFOR.png')}}" alt="Logo du groupe GEFOR">
    </div>
    <div>
        <p><strong>Matière :</strong> {{ $cours['matiere'] ?? '' }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($cours['date'])->format('d/m/Y') }}</p>
        <p><strong>Horaires :</strong> {{ \Carbon\Carbon::parse($cours['heure_debut'])->format('H\hi') }} - {{ \Carbon\Carbon::parse($cours['heure_fin'])->format('H\hi') }}</p>

        <canvas id="signature-pad" width=400 height=200></canvas>

        <form method="POST" action="{{ route('sign.store', absolute: false) }}" id="signature-form">
            @csrf
            <input type="hidden" name="cours_id" value="{{ $cours['id'] }}">
            <input type="hidden" name="signature" id="signature_input">
            <button type="button" id="save">Valider</button>
            <button type="button" id="clear">Effacer</button>
        </form>

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif
    </div>
    <p><a href="{{ route('home', absolute: false) }}">Retour page accueil</a></p>
</div>
@endsection