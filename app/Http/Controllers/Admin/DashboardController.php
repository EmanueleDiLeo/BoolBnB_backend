<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $n_apartments = Apartment::select('*')->where('user_id', Auth::id())->count();

        $sql = "SELECT DISTINCT `apartment_sponsor`.`apartment_id`\n"
            . "FROM `apartment_sponsor` \n"
            . "WHERE `end_date` > now();";

        // Esegui la query raw usando il metodo DB::select
        $results = DB::select($sql);

        // Estrai gli id degli appartamenti sponsorizzati da $results
        $ids = array_map(function ($result) {
            return $result->apartment_id;
        }, $results);

        $n_sponsors = Apartment::where('user_id', Auth::id())->whereIn('id', $ids)->count();

        $n_messages = Apartment::select('messages.id')->join('messages', function ($join) {
            $join->on('apartments.id', '=', 'messages.apartment_id');
        })->where('apartments.user_id', Auth::id())->count();

        $user = Auth::user();
        return view('admin.home', compact('n_apartments', 'user', 'n_sponsors', 'n_messages'));
    }
}
