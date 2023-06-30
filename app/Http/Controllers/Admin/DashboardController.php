<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $apartment = Apartment::orderByDesc("id")->get();
        return view('admin.dashboard', compact('apartment'));
    }
}
