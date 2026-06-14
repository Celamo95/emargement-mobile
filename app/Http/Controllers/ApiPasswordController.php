<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;


class ApiPasswordController extends Controller
{

    public function edit()
    {
        $user = Auth::user();

        return view('profil.editpassword', compact('user'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'password' => ['required', 'confirmed', Password::min(12)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => ['required'],
        ]);

        // On appelle l'API web pour modifier le profil en BDD MySQL
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->put('/password', [
                'password'      => $request->password,
            ]);

        if ($response->failed()) {
            return back()->with('error', 'Erreur lors de la mise à jour.');
        }

        Auth::user()->update([
            'password' => $request->password,
        ]);

        return redirect()->route('profil.show')->with('success', 'Mot de passe mis à jour');
    }
}
