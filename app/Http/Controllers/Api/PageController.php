<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Apartment;

class PageController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('visible', 1)->get();

        foreach ($apartments as $apartment){
            if($apartment) $success = true;
            else $success = false;
            if($success){
                if($apartment->img){
                    if(Str::contains($apartment->img, ['https://'])){

                    }
                    else{
                        $apartment->img = asset('storage/' . $apartment->img);
                    }
                }else{
                    $apartment->img = asset('storage/uploads/placeholder.webp');
                }
            }
        }

        return response()->json($apartments);
    }

    public function searchApartments($tosearch)
    {
        $apartments = Apartment::where('title', 'LIKE', '%' . $tosearch . '%')->with('services')->get();

        foreach ($apartments as $apartment){
            if($apartment) $success = true;
            else $success = false;
            if($success){
                if($apartment->img){
                    if(Str::contains($apartment->img, ['https://'])){

                    }
                    else{
                        $apartment->img = asset('storage/' . $apartment->img);
                    }
                }else{
                    $apartment->img = asset('storage/uploads/placeholder.webp');
                }
            }
        }

        return response()->json($apartments);
    }


    public function getSlugApartment($slug)
    {
        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        if ($apartment) {
            $success = true;
            if (!$apartment->img) {
                $apartment->img = asset('img/placeholder.webp');
            } else {
                $apartment->img = asset('storage/' . $apartment->img);
            }
        } else {
            $success = false;
        }

        return response()->json(compact('apartment', 'success'));
    }
}
