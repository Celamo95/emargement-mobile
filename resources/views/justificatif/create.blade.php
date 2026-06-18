@extends('layouts.base')

@section('title')
Justificatif
@endsection

@section('content')
<div style="max-width:400px; margin:0 auto; padding:30px 20px; font-family:'Lato',sans-serif;">

    <img src="{{ asset('images/Groupe-GEFOR.png') }}" alt="Logo GEFOR" style="display:block; margin:0 auto 30px; height:60px; width:auto;">

    <h2 style="text-align:center; color:#006cb1; margin-bottom:24px;">Déposer un justificatif</h2>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:#dc2626;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('justificatif.store', absolute: false) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="presence_id" value="{{ $presence_id }}">

        <div style="margin-bottom:16px;">
            <label style="font-weight:600; color:#374151;">Fichier (photo ou PDF)</label>
            <input type="file" name="fichier" accept="image/*,application/pdf" style="width:100%; margin-top:8px;">
        </div>

        <button type="submit" style="background:#006cb1; color:white; padding:12px 40px; border-radius:8px; border:none; font-weight:600; width:100%;">
            Envoyer
        </button>
    </form>

    <p style="text-align:center; margin-top:16px;">
        <a href="{{ route('home', absolute: false) }}" style="color:#006cb1;">Retour</a>
    </p>
</div>
@endsection