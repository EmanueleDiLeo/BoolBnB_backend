<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Apartment $apartment)
    {
        if ($apartment->user_id !== Auth::id()) {
            abort('404');
        };
        $sponsors = Sponsor::all();
        $apartment = Apartment::find($apartment->id);

        return view('admin.sponsors.sponsor', compact('sponsors', 'apartment'));
    }
}
