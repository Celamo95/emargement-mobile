@extends('layouts.base')

@section('title')
Aujourd'hui
@endsection

@section('content')
<div style="max-width:400px; margin:0 auto; padding:30px 20px; text-align:center; font-family:'Lato',sans-serif;">

    <img src="{{ asset('images/Groupe-GEFOR.png') }}" alt="Logo GEFOR" style="display:block; margin:0 auto 30px; height:60px; width:auto;">

    <p style="font-weight:700; font-size:1.1rem; margin-bottom:6px;">Mes cours</p>
    <p style="color:#6b7280; margin-bottom:30px;">{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y') }}</p>

    @forelse($cours as $c)
        <div style="background:white; border-radius:12px; padding:20px; margin-bottom:16px; text-align:center;">
            <p style="color:#6b7280; font-size:0.9rem; margin-bottom:6px;">{{ \Carbon\Carbon::parse($c['heure_debut'])->format('H\hi') }} - {{ \Carbon\Carbon::parse($c['heure_fin'])->format('H\hi') }}</p>
            <p style="font-weight:700; font-size:1rem; color:#1f2937; margin-bottom:6px;">{{ $c['matiere'] ?? '' }}</p>
            @if(!empty($c['user']['name']))
                <p style="color:#6b7280; font-size:0.85rem; margin-bottom:12px;">{{ $c['user']['name'] }}</p>
            @endif
            <a href="{{ route('sign', $c['id']) }}" style="display:inline-block; background:#006cb1; color:white; padding:10px 40px; border-radius:8px; text-decoration:none; font-weight:600;">Signer</a>
        </div>
    @empty
        <p style="color:#6b7280;">Aucun cours aujourd'hui.</p>
    @endforelse

</div>
@endsection