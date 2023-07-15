<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config('data.services');
        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service["name"];
            $newService->image = $service["image"];
            $newService->save();
        }
    }
}
