@extends('layouts.base')

@section('title')
Connexion
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')

{{-- Show a generic error message if needed --}}
    @if (session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

<div class="logo">
    <img src="{{asset('images/Groupe-GEFOR.png')}}" alt="Logo du groupe GEFOR">
</div>
<div class="form">
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <input 
        type="email" 
        id="email" 
        name="email" 
        placeholder="Identifiant"
        autocomplete="email"
        >
        <input 
        type="password" 
        id="password" 
        name="password" 
        placeholder="Mot de passe"
        autocomplete="current-password"
        >
        <button type="submit">Connexion</></button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            document.querySelector('form').submit();
        }
    });
</script>
@endpush

@endsection