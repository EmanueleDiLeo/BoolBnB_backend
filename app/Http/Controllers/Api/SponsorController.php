<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SponsorResource;
use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function index(Request $request){
        $sponsors= Sponsor::all();
        return SponsorResource::collection($sponsors);
    }

}
