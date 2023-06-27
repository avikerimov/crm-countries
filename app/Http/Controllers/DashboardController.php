<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return view('dashboard', compact('countries'));
    }
}
