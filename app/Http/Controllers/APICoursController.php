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

        $today = now()->toDateString();

        $cours = collect($response->json())->filter(function ($c) use ($today) {
            return $c['date'] === $today;
        })->values();

        return view('home', [
            'cours' => $cours,
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
