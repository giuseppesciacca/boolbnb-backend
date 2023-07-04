<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(100);
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        //Add validation
        $val_data = $request->validated();
        $slug = Apartment::generateSlug($val_data['title']);

        //create new apartment
        
        //generate slug
        
        //validata slug and user_id
        $val_data['slug'] = $slug;
        $val_data['user_id'] = Auth::id();

        //generate static latitude and longitude
        $latitude = 10.9876;
        $longitude = 98.12134;
        $val_data['latitude'] = $latitude;
        $val_data['longitude'] = $longitude;
        
        $new_apartment = Apartment::create($val_data);

        if ($request['services']) {
            $new_apartment->services()->sync($val_data['services']);
        }

        //add image
        if ($request->hasFile('image')) {
            $img_path = Storage::put('uploads', $request->image);
            
            $new_apartment->image = $img_path;
            $new_apartment->save();
        }
        
        
        
        
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
        if (Auth::id() === $apartment->user_id) {

            return view('admin.apartments.show', compact('apartment'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            $services = Service::all();

            return view('admin.apartments.edit', compact('apartment', 'services'));
        }
        abort(403);
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
        $val_data = $request->validated();
        $slug = Apartment::generateSlug($val_data['title']);
        $val_data['slug'] = $slug;

        if ($request['services']) {
            $apartment->services()->sync($val_data['services']);
        }

        //validate image
        if ($request->hasFile('image')) {
            if ($apartment['image']) {
                Storage::delete($apartment->image);
            }
            $img_path = Storage::put('uploads', $request->image);
            $val_data['image'] = $img_path;
        }


        $apartment->update($val_data);


        return to_route('admin.apartments.index')->with('message', 'apartment: ' . $apartment->title . ' Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {

        if ($apartment->image) {
            Storage::delete($apartment->image);
        }
        $apartment->delete();
        return to_route('admin.apartments.index')->with('message', 'apartment: ' . $apartment->title . ' Deleted');
    }
}
