<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = config('data.sponsors');
        foreach ($sponsors as $sponsor) {
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsor["name"];
            $newSponsor->duration = $sponsor["duration"];
            $newSponsor->price = $sponsor["price"];
            $newSponsor->save();
            // before seeding the apartments insert in the db at least 3 users
        }
    }
}
