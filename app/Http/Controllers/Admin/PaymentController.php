<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index(Apartment $apartment)
    {
        if ($apartment->user_id !== Auth::id()) {
            abort('404');
        };
        $sponsors = Sponsor::all();
        $apartment = Apartment::find($apartment->id);
        // $response = Http::get('http://127.0.0.1:8000/api/generate');
        // $data = $response->json('results');


        return view('admin.sponsors.sponsor', compact('sponsors', 'apartment'));
    }
}
