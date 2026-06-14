<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class ApiProfilController extends Controller
{

    public function show()
    {
        // Auth::user() récupère l'utilisateur connecté via la session
        $user = Auth::user();

        return view('profil.show', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();

        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email'     => ['required', 'email'],
        ]);

        // On appelle l'API web pour modifier le profil en BDD MySQL
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->put('/profil', [
                'name'      => $request->name,
                'firstname' => $request->firstname,
                'email'     => $request->email,
            ]);


        if ($response->failed()) {
            return back()->with('error', 'Erreur lors de la mise à jour.');
        }

        // Met à jour aussi l'utilisateur local SQLite
        Auth::user()->update([
            'name'      => $request->name,
            'firstname' => $request->firstname,
            'email'     => $request->email,
        ]);

        return redirect()->route('profil.show')->with('success', 'Profil mis à jour');
    }
}
