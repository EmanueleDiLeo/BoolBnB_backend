<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class PageController extends Controller
{
    public function index(){
        $apartments = Apartment::all();
        return view('guest.home', compact('apartments'));
    }


}
