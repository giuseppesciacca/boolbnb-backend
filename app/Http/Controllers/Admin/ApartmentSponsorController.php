<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\ApartmentSponsor;
use App\Models\Apartment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApartmentSponsorRequest;
use App\Http\Requests\UpdateApartmentSponsorRequest;
use Illuminate\Support\Facades\Auth;

class ApartmentSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $apartmentId = $request->query('apartment'); //prendo i valori dall'url
        $sponsorId = $request->query('sponsor');

        $apartment = Apartment::where('id', '=', $apartmentId)->first(); //prendo l'elemento che l'id corrispondente
        $sponsor = Sponsor::where('id', '=', $sponsorId)->first();

        return view('admin.payments.create', compact('apartment', 'sponsor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentSponsorRequest $request)
    {
        $val_data = $request->validated();

        $val_data['apartment_id'] = $request->apartment;
        $val_data['sponsor_id'] = $request->sponsor;

        $val_data['start_date'] = Carbon::now()->timezone('Europe/Rome');

        if ($request->sponsor == 1) {
            $expireDate = Carbon::now()->timezone('Europe/Rome')->addHours(24);
        } elseif ($request->sponsor == 2) {
            $expireDate = Carbon::now()->timezone('Europe/Rome')->addHours(72);
        } else {
            $expireDate = Carbon::now()->timezone('Europe/Rome')->addHours(144);
        }

        $val_data['expire_date'] = $expireDate;

        ApartmentSponsor::create($val_data);

        return back()->with('message', 'Sponsorizzazione aggiunta con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApartmentSponsor  $apartmentSponsor
     * @return \Illuminate\Http\Response
     */
    public function show(ApartmentSponsor $apartmentSponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApartmentSponsor  $apartmentSponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(ApartmentSponsor $apartmentSponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentSponsorRequest  $request
     * @param  \App\Models\ApartmentSponsor  $apartmentSponsor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentSponsorRequest $request, ApartmentSponsor $apartmentSponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApartmentSponsor  $apartmentSponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApartmentSponsor $apartmentSponsor)
    {
        //
    }
}
