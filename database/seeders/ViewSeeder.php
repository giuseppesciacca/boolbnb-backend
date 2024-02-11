<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 400; $i++) {

            $view = new View();
            $view->apartment_id = $faker->numberBetween(1, 20);
            $view->ip_address = $faker->ipv4;
            $view->date_view = $faker->dateTimeBetween('-5 year', 'now')->format('Y-m-d H:i:s');
            $view->save();
        }
    }
}
