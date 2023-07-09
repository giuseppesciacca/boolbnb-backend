<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'sponsors')->orderBy('title')->paginate(8);
        $all_apartments = Apartment::with('services', 'sponsors')->get();
        return response()->json([
            'success' => true,
            'results' => $apartments,
            'all_apartments' => $all_apartments
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services', 'sponsors')->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'result' => $apartment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => '404 Apartment not found'
            ]);
        };
    }
}
