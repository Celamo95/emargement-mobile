<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ApiJustificatifController extends Controller
{
     // Affiche le formulaire de dépôt de justificatif
    public function create(Request $request)
    {
        return view('justificatif.create', [
            'presence_id' => $request->query('presence_id'),
        ]);
    }

    // Envoie le justificatif à l'API web
    public function store(Request $request)
    {
        $request->validate([
            'fichier'      => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'presence_id'  => ['required', 'integer'],
        ]);

        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->attach('fichier', file_get_contents($request->file('fichier')->getRealPath()), $request->file('fichier')->getClientOriginalName())
            ->post('/justificatif', [
                'presence_id' => $request->presence_id,
            ]);

        if ($response->failed()) {
            return back()->with('error', 'Erreur lors du dépôt du justificatif.');
        }

        return redirect()->route('home')->with('success', 'Justificatif envoyé.');
    }
}
