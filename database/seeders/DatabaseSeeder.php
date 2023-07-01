<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([  
            ApartmentSeeder::class,
            // before seeding the apartments insert in the db at least 3 users
            ServiceSeeder::class,
            SponsorSeeder::class,   
        ]); 
        
    }
}
