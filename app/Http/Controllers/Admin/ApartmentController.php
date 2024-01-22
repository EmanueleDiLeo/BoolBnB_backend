<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ApartmentRequest;
use App\Functions\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    // Custome functions
    public function messageApartment(Apartment $apartment)
    {
        if ($apartment->user_id !== Auth::id()) {
            abort('404');
        };
        $number_messages = Message::where('apartment_id', $apartment->id)->count();
        $messages = Message::where('apartment_id', $apartment->id)->get();
        return view('admin.apartments.message', compact('messages', 'number_messages'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title  = 'Inserisci appartamento';
        $method = 'POST';
        $route = route('admin.apartments.store');
        $button = 'Crea';
        $services = Service::all();
        $apartment = null;
        $address = null;

        $visible = 0;
        $text = 'text-danger';
        $required = 'required';
        $active_services = 0;
        return view('admin.apartments.create-edit', compact('title', 'method', 'route', 'button', 'services', 'apartment', 'address', 'visible', 'text', 'required', 'active_services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentRequest $request)
    {
        $form_data = $request->all();

        $form_data['slug'] = Helper::generateSlug($form_data['title'], Apartment::class);
        $form_data['user_id'] = Auth::id();
        $link1 = 'https://api.tomtom.com/search/2/geocode/';
        $link2 = '.json?countrySet=IT&key=mqY8yECF75lXPuk7LVSI3bFjFtyEAbEX';

        $response = Http::get($link1 . $form_data['address'] . $link2);

        $data = $response->json('results')[0];

        $lat = $data['position']['lat'];
        $lon = $data['position']['lon'];

        $form_data['lat'] = $lat;
        $form_data['lon'] = $lon;

        if (empty($form_data['visible'])) {
            $form_data['visible'] = 0;
        }


        $data = request()->validate([
            'img' => 'required|file|mimes:jpeg,jpg,png,webp'
        ]);

        if (array_key_exists('img', $form_data)) {
            $form_data['img_name'] = $request->file('img')->getClientOriginalName();
            $form_data['img'] = Storage::put('uploads', $form_data['img']);
        }

        $new_apartment = Apartment::create($form_data);
        if (array_key_exists('services', $form_data)) {
            $new_apartment->services()->attach($form_data['services']);
        }

        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->user_id !== Auth::id()) {
            abort('404');
        };
        $apartment = Apartment::where('id', $apartment->id)->where('user_id', Auth::id())->first();
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        if ($apartment->user_id !== Auth::id()) {
            abort('404');
        };
        $title  = 'Modifica appartamento';
        $method = 'PUT';
        $route = route('admin.apartments.update', $apartment);
        $button = 'Modifica';
        $separated_address = explode(',', $apartment->address);
        $visible = $apartment->visible;
        $address = $apartment->address;
        $text = 'text-success';
        $required = '';
        $active_services = $apartment->services->count();
        $services = Service::all();
        return view('admin.apartments.create-edit', compact('title', 'method', 'route', 'button', 'services', 'apartment', 'address', 'visible', 'text', 'required', 'active_services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->all();
        if ($form_data['title'] != $apartment->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Apartment::class);
        } else {
            $form_data['slug'] = $apartment->slug;
        }


        if (array_key_exists('img', $form_data)) {

            if ($apartment->image) {

                Storage::disk('public')->delete($apartment->img);
            }


            $form_data['img_name'] = $request->file('img')->getClientOriginalName();

            $form_data['img'] = Storage::put('uploads', $form_data['img']);
        }

        if (empty($form_data['visible'])) {
            $form_data['visible'] = 0;
        }



        if ($form_data['address'] != $apartment->address) {
            $link1 = 'https://api.tomtom.com/search/2/geocode/';
            $link2 = '.json?countrySet=IT&key=mqY8yECF75lXPuk7LVSI3bFjFtyEAbEX';

            $response = Http::get($link1 . $form_data['address'] . $link2);

            $data = $response->json('results')[0];

            $lat = $data['position']['lat'];
            $lon = $data['position']['lon'];

            $form_data['lat'] = $lat;
            $form_data['lon'] = $lon;
        }

        $apartment->update($form_data);

        if (array_key_exists('services', $form_data)) {
            $apartment->services()->sync($form_data['services']);
        } else {
            $apartment->services()->detach();
        }


        return redirect()->route('admin.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->img) {
            Storage::disk('public')->delete($apartment->img);
        }

        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('success',  ' Appartamento ' . $apartment->title . ' eliminato con successo');
    }
}
