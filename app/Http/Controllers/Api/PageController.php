<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PageController extends Controller
{
    public function index()
    {
        $apartments = DB::table('apartments')
            ->join('apartment_sponsor', function ($join) {
                $join->on('apartments.id', '=', 'apartment_sponsor.apartment_id');
            })
            ->where('end_date', '>=', Carbon::now())
            ->inRandomOrder()
            ->get();

        $apartments = $apartments->unique('apartment_id');

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
        $services = Service::all();
        foreach ($services as $service) {
            $service->icon = asset('storage/icons/' . $service->icon);
        }
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
        $radius = 15;

        $apartments = Apartment::select('*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                       cos( radians( lat ) )
                       * cos( radians( lon ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( lat ) ) )
                     ) AS distance', [$lat, $lon, $lat])
            ->leftJoin('apartment_sponsor', function ($join) {
                $join->on('apartments.id', '=', 'apartment_sponsor.apartment_id');})
            ->where('visible', 1)
            ->with('services')
            ->orderByRaw("CASE WHEN apartment_sponsor.end_date > now() THEN 0 ELSE 1 END, distance asc")
            ->havingRaw("distance < ?", [$radius]);


        $apartments = $apartments->get();

        $apartments = $apartments->unique('id');

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

    public function searchAdvanceApartments(Request $request)
    {

        $address = $request->query('address');
        $radius = $request->query('radius');
        $services = $request->query('services');
        $rooms = $request->query('rooms');
        $beds = $request->query('beds');

        $link1 = 'https://api.tomtom.com/search/2/geocode/';
        $link2 = '.json?countrySet=IT&key=mqY8yECF75lXPuk7LVSI3bFjFtyEAbEX';
        $response = Http::get($link1 . $address . $link2);
        $data = $response->json('results')[0];
        $lat = $data['position']['lat'];
        $lon = $data['position']['lon'];

        $apartments = Apartment::select('*')
            ->with('services')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) )
                    * cos( radians( lon ) - radians(?)
                    ) + sin( radians(?) ) *
                    sin( radians( lat ) ) )
                    ) AS distance', [$lat, $lon, $lat])
            ->leftJoin('apartment_sponsor', function ($join) {
                $join->on('apartments.id', '=', 'apartment_sponsor.apartment_id');})
            ->where('visible', 1)
            ->where('room_number', '>=', $rooms)
            ->where('bed_number', '>=', $beds)
            ->orderByRaw("CASE WHEN apartment_sponsor.end_date > now() THEN 0 ELSE 1 END, distance asc")
            ->havingRaw("distance < ?", [$radius]);

        if ($services) {
            foreach ($services as $service) {
                $apartments->whereHas('services', function ($query) use ($service) {
                    $query->where('service_id', $service);
                });
            }
        }
        $apartments = $apartments->get();
        $apartments = $apartments->unique('id');


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
