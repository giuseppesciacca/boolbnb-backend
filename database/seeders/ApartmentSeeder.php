<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('data');
        foreach ($apartments as $apartment) {
            $newApartment = new Apartment();
            $newApartment->user_id = $apartment["user_id"];
            $newApartment->title = $apartment["title"];
            $newApartment->slug = Str::slug($newApartment->title, '-');
            $newApartment->image = $apartment["image"];
            $newApartment->description = $apartment["description"];
            $newApartment->rooms = $apartment["rooms"];
            $newApartment->bathrooms = $apartment["bathrooms"];
            $newApartment->beds = $apartment["beds"];
            $newApartment->square_meters = $apartment["square_meters"];
            $newApartment->address = $apartment["address"];
            $newApartment->latitude = $apartment["latitude"];
            $newApartment->longitude = $apartment["longitude"];
            $newApartment->visibility = $apartment["visibility"];
            $newApartment->save();
        }

    }
}
