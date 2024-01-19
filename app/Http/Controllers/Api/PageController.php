<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('visible', 1)->get();

        foreach ($apartments as $apartment) {
            if ($apartment) $success = true;
            else $success = false;
            if ($success) {
                if ($apartment->img) {
                    if (Str::contains($apartment->img, ['https://'])) {
                    } else {
                        $apartment->img = asset('storage/' . $apartment->img);
                    }
                } else {
                    $apartment->img = asset('storage/uploads/placeholder.webp');
                }
            }
        }

        return response()->json($apartments);
    }

    public function getServices()
    {
        $services= Service::all();
        return response()->json($services);
    }

    public function searchDistanceApartments($address)
    {

        $link1 = 'https://api.tomtom.com/search/2/geocode/';
        $link2 = '.json?countrySet=IT&key=mqY8yECF75lXPuk7LVSI3bFjFtyEAbEX';
        $response = Http::get($link1 . $address . $link2);
        $data = $response->json('results')[0];
        $lat = $data['position']['lat'];
        $lon = $data['position']['lon'];
        $radius = 20;

        $apartments = Apartment::select('apartments.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                       cos( radians( lat ) )
                       * cos( radians( lon ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( lat ) ) )
                     ) AS distance', [$lat, $lon, $lat])
            ->where('visible', 1)
            ->with('services')
            ->havingRaw("distance < ?", [$radius])
            ->get();

        foreach ($apartments as $apartment) {
            if ($apartment) $success = true;
            else $success = false;
            if ($success) {
                if ($apartment->img) {
                    if (Str::contains($apartment->img, ['https://'])) {
                    } else {
                        $apartment->img = asset('storage/' . $apartment->img);
                    }
                } else {
                    $apartment->img = asset('storage/uploads/placeholder.webp');
                }
            }
        }

        return response()->json($apartments);
    }

    public function searchApartments($tosearch)
    {
        $apartments = Apartment::where('title', 'LIKE', '%' . $tosearch . '%')->with('services')->get();

        foreach ($apartments as $apartment) {
            if ($apartment) $success = true;
            else $success = false;
            if ($success) {
                if ($apartment->img) {
                    if (Str::contains($apartment->img, ['https://'])) {
                    } else {
                        $apartment->img = asset('storage/' . $apartment->img);
                    }
                } else {
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
