@extends('layouts.base')

@section('title')
Aujourd'hui
@endsection

@section('content')
<div class="nativephp-safe-area">
    <div class="logo">
        <img src="{{asset('images/Groupe-GEFOR.png')}}" alt="Logo du groupe GEFOR">
    </div>

    <p>Bonjour, {{ Auth::user()->name }}</p>
    <a href="{{ route('logout') }}">Se déconnecter</a>

    <h3>Mes cours</h3>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @forelse($cours as $c)
        <div class="morning">
            <p><strong>Matière :</strong> {{ $c['matiere'] ?? '' }}</p>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($c['date'])->format('d/m/Y') }}</p>
            <p><strong>Horaires :</strong> {{ \Carbon\Carbon::parse($c['heure_debut'])->format('H\hi') }} à {{ \Carbon\Carbon::parse($c['heure_fin'])->format('H\hi') }}</p>
            <p><strong>Salle :</strong> {{ $c['salle'] ?? '' }}</p>
            <p><strong>Professeur :</strong> {{ $c['user']['name'] ?? '' }} {{ $c['user']['prenom'] ?? '' }}</p>
            <a href="{{ route('sign', $c['id']) }}">Signer</a>
        </div>
    @empty
        <p>Aucun cours trouvé.</p>
    @endforelse
</div>
@endsection