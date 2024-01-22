<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\User;


class AdminController extends Controller
{
    public function authenticate (request $request){

        $user = Auth::user();
        return response()->json(['user' => $user]);

    }
}
