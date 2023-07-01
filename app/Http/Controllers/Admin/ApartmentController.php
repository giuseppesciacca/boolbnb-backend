<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$apartments = Auth::user()->apartments()->orderBy('id')->paginate(5);
        $apartments = Apartment::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(5);


        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* poi da passare i servizi */
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        //dd($request);
        //Add validation
        $val_data = $request->validated();
        //generate slug
        $slug = Apartment::generateSlug($val_data['title']);
        //validata slug and user_id
        $val_data['slug'] = $slug;
        $val_data['user_id'] = Auth::id();
        //to do checking  image and make storage link
        
        //generate static latitude and longitude
        $latitude = 10.9876;
        $longitude = 98.12134;
        $val_data['latitude'] = $latitude;
        $val_data['longitude'] = $longitude;

        $newApartment = Apartment::create($val_data);

        return to_route('admin.apartments.index')->with('message', 'Appartamento aggiunto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
