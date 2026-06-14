@extends('layouts.base')

@section('title')
Aujourd'hui
@endsection



@section('content')
<div style="max-width:400px; margin:0 auto; padding:30px 20px; text-align:center; font-family:'Lato',sans-serif;">

    <img src="{{ asset('images/Groupe-GEFOR.png') }}" alt="Logo GEFOR" style="display:block; margin:0 auto 30px; height:60px; width:auto;">

    <p style="font-weight:700; font-size:1.1rem; margin-bottom:6px;">Mes cours</p>

    {{-- Navigation par date, flèches SVG avec zone de tap mobile --}}
<div style="display:flex; align-items:center; justify-content:center; gap:16px; margin-bottom:24px;">
    <button id="btn-prev" onclick="changeDay(-1)" style="background:none; border:none; cursor:pointer; padding:12px; color:#006cb1;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#006cb1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>
    <p id="label-date" style="color:#6b7280; margin:0; min-width:180px;"></p>
    <button id="btn-next" onclick="changeDay(1)" style="background:none; border:none; cursor:pointer; padding:12px; color:#006cb1;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#006cb1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>
</div>
    {{-- Conteneur des cours par date --}}
    @forelse($cours as $date => $coursDuJour)
        <div class="jour-bloc" data-date="{{ $date }}" style="display:none;">
            @foreach($coursDuJour as $c)
                <div style="background:white; border-radius:12px; padding:20px; margin-bottom:16px; text-align:center;">
                    <p style="color:#6b7280; font-size:0.9rem; margin-bottom:6px;">
                        {{ \Carbon\Carbon::parse($c['heure_debut'])->format('H\hi') }} - {{ \Carbon\Carbon::parse($c['heure_fin'])->format('H\hi') }}
                    </p>
                <p style="font-weight:700; font-size:1rem; color:#1f2937; margin-bottom:6px;">{{ isset($c['matiere']) ? $c['matiere']['nom'] : '' }}</p>
                    <a href="{{ route('sign', ['id'=>$c['id']], absolute: false) }}" style="display:inline-block; background:#006cb1; color:white; padding:10px 40px; border-radius:8px; text-decoration:none; font-weight:600;">Signer</a>
                </div>
            @endforeach
        </div>
    @empty
        <p style="color:#6b7280;">Aucun cours.</p>
    @endforelse

    <a href="{{ route('profil.show') }}">Mon profil</a>

</div>

@push('scripts')
<script>
    const blocs = document.querySelectorAll('.jour-bloc');
    const dates = Array.from(blocs).map(b => b.dataset.date);
    let currentIndex = 0;

    const today = new Date().toISOString().slice(0, 10);
    const todayIndex = dates.indexOf(today);
    if (todayIndex !== -1) currentIndex = todayIndex;

    function formatDate(dateStr) {
        const d = new Date(dateStr + 'T00:00:00');
        return d.toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }

    function render() {
        blocs.forEach((b, i) => {
            b.style.display = i === currentIndex ? 'block' : 'none';
        });
        document.getElementById('label-date').textContent = formatDate(dates[currentIndex]);
        document.getElementById('btn-prev').style.visibility = currentIndex > 0 ? 'visible' : 'hidden';
        document.getElementById('btn-next').style.visibility = currentIndex < dates.length - 1 ? 'visible' : 'hidden';
    }

    function changeDay(direction) {
        const newIndex = currentIndex + direction;
        if (newIndex >= 0 && newIndex < dates.length) {
            currentIndex = newIndex;
            render();
        }
    }

    // MODIFIÉ : swipe tactile
    let touchStartX = 0;

    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].clientX;
    });

    document.addEventListener('touchend', function(e) {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) {
            changeDay(diff > 0 ? 1 : -1);
        }
    });

    if (dates.length > 0) render();
</script>
@endpush

@endsection