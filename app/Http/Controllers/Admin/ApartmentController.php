<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
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
        $is_sponsored = Apartment::join('apartment_sponsor', 'id', '=', 'apartment_id')->where('expire_date', '>', Carbon::now()->timezone('Europe/Rome'))->where('start_date', '<', Carbon::now()->timezone('Europe/Rome'))->get();   
        //dd($is_sponsored);
        $apartments = Apartment::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(100);
        return view('admin.apartments.index', compact('apartments', 'is_sponsored'));
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

        //validata slug and user_id
        $val_data['slug'] = $slug;
        $val_data['user_id'] = Auth::id();

        /* ***** call api GET to tomtom -> convert address in latitude longitude */
        $base_url = 'https://api.tomtom.com/search/2/geocode/';
        $address = $val_data['address'];   //via fardella 120 Trapani
        $address_trasformed = str_replace(' ', '%20', $address); //via%20fardella%20120%20trapani
        $after_address = '.json?storeResult=false&view=Unified&key=';
        $key_tomtom = 'vPuUkOEvt9S93r8E98XRbrHJJG1Mz6Tr';

        $final_query = $base_url . $address_trasformed . $after_address . $key_tomtom;
        //es: https://api.tomtom.com/search/2/geocode/via%20fardella%20120%20trapani.json?storeResult=false&view=Unified&key=vPuUkOEvt9S93r8E98XRbrHJJG1Mz6Tr

        $options = [
            'http' => [
                'method' => 'GET',
                'header' => 'Content-Type: application/json',
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($final_query, false, $context);

        if ($response !== false) {
            //converto la risposta json in array
            $response_converted = json_decode($response);

            //dd($response_converted);
            //dd($response_converted->results[0]->position);
        } else {
            echo 'Errore nella chiamata GET';
        }

        /* ******** */

        if ($response_converted->results) {
            $val_data['latitude'] = $response_converted->results[0]->position->lat;
            $val_data['longitude'] = $response_converted->results[0]->position->lon;
        } else {
            return redirect()->back()->withErrors('L\'indirizzo inserito non è corretto.');
        }


        $new_apartment = Apartment::create($val_data);

        if ($request['services']) {
            $new_apartment->services()->sync($val_data['services']);
        }

        $images = [];

        //add image
        if ($request->hasFile('image')) {

            foreach ($val_data['image'] as $image) {
                $img_path = Storage::put('uploads', $image);
                array_push($images, $img_path);
            }

            $new_apartment->image = $images;
            //dd($new_apartment->image = $images);
            $new_apartment->save();
        }

        return to_route('admin.apartments.index')->with('message', $new_apartment->title . ' aggiunto con successo.');
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
        if ($request['services'] === null) {
            $apartment->services()->detach();
        }
        //dd($request['services']);

        //validate image
        $images = [];
        if ($request->hasFile('image')) {
            if ($apartment['image']) {
                foreach ($val_data['image'] as $image) {
                    Storage::delete($apartment->image);
                }
            }

            foreach ($val_data['image'] as $image) {
                $img_path = Storage::put('uploads', $image);
                array_push($images, $img_path);
            }
            $val_data['image'] = $images;
        }

        /* ***** call api GET to tomtom -> convert address in latitude longitude */
        $base_url = 'https://api.tomtom.com/search/2/geocode/';
        $address = $val_data['address'];   //via fardella 120 Trapani
        $address_trasformed = str_replace(' ', '%20', $address); //via%20fardella%20120%20trapani
        $after_address = '.json?storeResult=false&view=Unified&key=';
        $key_tomtom = 'vPuUkOEvt9S93r8E98XRbrHJJG1Mz6Tr';

        $final_query = $base_url . $address_trasformed . $after_address . $key_tomtom;
        //es: https://api.tomtom.com/search/2/geocode/via%20fardella%20120%20trapani.json?storeResult=false&view=Unified&key=vPuUkOEvt9S93r8E98XRbrHJJG1Mz6Tr

        $options = [
            'http' => [
                'method' => 'GET',
                'header' => 'Content-Type: application/json',
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($final_query, false, $context);

        if ($response !== false) {
            //converto la risposta json in array
            $response_converted = json_decode($response);

            //dd($response_converted);
            //dd($response_converted->results[0]->position);
        } else {
            echo 'Errore nella chiamata GET';
        }

        /* ******** */

        if ($response_converted->results) {
            $val_data['latitude'] = $response_converted->results[0]->position->lat;
            $val_data['longitude'] = $response_converted->results[0]->position->lon;
        } else {
            return redirect()->back()->withErrors('L\'indirizzo inserito non è corretto.');
        }

        $apartment->update($val_data);


        return to_route('admin.apartments.index')->with('message', $apartment->title . ' modificato con successo.');
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
        return to_route('admin.apartments.index')->with('message', $apartment->title . ' eliminato con successo.');
    }
}
