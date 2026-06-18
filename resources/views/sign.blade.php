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
        <p><strong>Formation :</strong> {{ $cours['formation']['name'] ?? '' }}</p>
        <p><strong>Matière :</strong> {{ $cours['matiere']['nom'] ?? '' }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($cours['date'])->format('d/m/Y') }}</p>
        <p><strong>Horaires :</strong> {{ \Carbon\Carbon::parse($cours['heure_debut'])->format('H\hi') }} - {{ \Carbon\Carbon::parse($cours['heure_fin'])->format('H\hi') }}</p>

        @if(Auth::user()->statut === 'formateur')
            {{-- VUE FORMATEUR --}}
            <form method="POST" action="{{ route('sign.store', absolute: false) }}" id="signature-form">
                @csrf
                <input type="hidden" name="cours_id" value="{{ $cours['id'] }}">
                <input type="hidden" name="signature" id="signature_input">

                <h3>Présences</h3>
                @foreach($apprenants as $apprenant)
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <label for="apprenant_{{ $apprenant['id'] }}">
                            {{ $apprenant['name'] }} {{ $apprenant['firstname'] }}
                        </label>
                        <input type="checkbox" 
                               name="presences[{{ $apprenant['id'] }}]" 
                               value="present" 
                               id="apprenant_{{ $apprenant['id'] }}"
                               checked>
                    </div>
                @endforeach

                <canvas id="signature-pad" width=400 height=200></canvas>
                <button type="button" id="save">Valider</button>
                <button type="button" id="clear">Effacer</button>
            </form>

        @else
            {{-- VUE APPRENANT --}}
            @if($presence && $presence['valide_formateur'] && $presence['statut'] === 'present')
                {{-- Formateur a validé et apprenant est présent → peut signer --}}
                <form method="POST" action="{{ route('sign.store', absolute: false) }}" id="signature-form">
                    @csrf
                    <input type="hidden" name="cours_id" value="{{ $cours['id'] }}">
                    <input type="hidden" name="signature" id="signature_input">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <canvas id="signature-pad" width=400 height=200></canvas>
                    <button type="button" id="save">Valider ma présence</button>
                    <button type="button" id="clear">Effacer</button>
                </form>

            @elseif($presence && $presence['statut'] === 'absent')
                {{-- Apprenant absent → déposer justificatif --}}
                <p style="color:#dc2626;">Vous êtes marqué absent pour ce cours.</p>
                <a href="{{ route('justificatif.create', ['presence_id' => $presence['id']], absolute: false) }}">Déposer un justificatif</a>

            @else
                {{-- Formateur n'a pas encore validé --}}
                <p style="color:#6b7280;">En attente de validation du formateur.</p>
            @endif
        @endif

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif
    </div>
    <p><a href="{{ route('home', absolute: false) }}">Retour page accueil</a></p>
</div>
@endsection