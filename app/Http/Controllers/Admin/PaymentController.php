<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;

class PaymentController extends Controller
{
    public function index () {
        $sponsors= Sponsor::all();
        return view('admin.sponsors.sponsor', compact('sponsors'));
    }
}
