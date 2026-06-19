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
    <form method="POST" action="{{ route('login.post',absolute: false) }}">
        @csrf
        <input 
        type="email" 
        id="email" 
        name="email" 
        placeholder="Identifiant"
        autocomplete="email"
        autofocus
        >
        <input 
        type="password" 
        id="password" 
        name="password" 
        placeholder="Mot de passe"
        autocomplete="current-password"
        >
        <button type="submit">Connexion</button>
    </form>

    <p style="text-align:center; margin-top:16px;">
        <a href="{{ config('services.web.url') }}/forgot-password" style="color:#006cb1;">Mot de passe oublié ?</a>
    </p>

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