<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class APICoursController extends Controller
{
    public function index()
    {
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->get('/cours');

        if ($response->failed()) {
            abort($response->status(), 'Impossible de récupérer les cours');
        }

        return view('home', [
            'cours' => $response->json(),
        ]);
    }

    public function show(int $id)
    {
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->get("/cours/{$id}");

        return view('sign', [
            'cours' => $response->json(),
        ]);
    }
}
