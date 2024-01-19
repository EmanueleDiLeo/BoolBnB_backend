<?php

namespace App\Http\Controllers\Api\Sponsors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Http\Resources\SponsorResource;

class SponsorController extends Controller
{
    public function index(Request $request){
        $sponsors= Sponsor::all();
        return SponsorResource::collection($sponsors);
    }
}
