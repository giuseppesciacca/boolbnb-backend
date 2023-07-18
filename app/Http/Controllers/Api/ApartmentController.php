<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'sponsors')->where('visibility', '=', '1')->orderBy('title')->paginate(50);
        $all_apartments = Apartment::with('services', 'sponsors')->where('visibility', '=', '1')->get();
        /** 
         * query sql di apartmentsSponsored
         *SELECT *
         *FROM `apartments`
         *JOIN `apartment_sponsor` ON `apartments`.id = apartment_id
         *WHERE expire_date > NOW()
         *  AND start_date < NOW()
         */
        $apartmentsSponsored = Apartment::join('apartment_sponsor', 'id', '=', 'apartment_id')->where('expire_date', '>', Carbon::now()->timezone('Europe/Rome'))->where('start_date', '<', Carbon::now()->timezone('Europe/Rome'))->where('visibility', '=', '1')->with('services', 'sponsors')->orderBy('title')->paginate(50);

        return response()->json([
            'success' => true,
            'results' => $apartments,
            'all_apartments' => $all_apartments,
            'all_apartments_sponsored' => $apartmentsSponsored
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
