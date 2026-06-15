<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ApiSignatureController extends Controller
{
    /**
     * @throws ConnectionException
     */
    public function show(int $id)
    {
        // Récupère les données du cours
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->get('/cours/' . $id);
            $cours = $response->json();

            // Récupère les apprenants de la formation de ce cours
        $responseApprenants = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->get('/apprenants', ['formation_id' => $cours['formation_id']]);

        $apprenants = $responseApprenants->json();

        return view('sign', compact('cours', 'apprenants'));
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'signature' => ['required', 'string'],
        'cours_id'  => ['required', 'integer'],
    ]);

    $data['user_id'] = Auth::id();
    
    // Récupère les présences cochées — tableau [apprenant_id => 'present']
    // Les non cochées ne sont pas envoyées donc = absent
    $data['presences'] = $request->input('presences', []);

    $response = Http::baseUrl(config('services.api.url'))
        ->acceptJson()
        ->withToken(Session::get('remote_auth_token'))
        ->post('/signature', $data);

    if (! $response->successful()) {
        return back()->with('error', 'Erreur lors de l\'enregistrement de la signature distante.');
    }
    
    return response('', 302)->header('Location', route('home', [], false));
}
}
