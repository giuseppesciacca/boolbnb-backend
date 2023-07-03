<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Luca', 'surname' => 'Piacentini', 'date_of_birth' => '1996-04-15', 'email' => 'lucap@dev.com', 'password' => Hash::make('password'),]);
        User::create(['name' => 'Luca', 'surname' => 'Cirigliano', 'date_of_birth' => '1994-03-22', 'email' => 'lucac@dev.com', 'password' => Hash::make('password'),]);
        User::create(['name' => 'Domiziano', 'surname' => 'De Santis', 'date_of_birth' => '1997-07-24', 'email' => 'dom@dev.com', 'password' => Hash::make('password'),]);
        User::create(['name' => 'Carmelo', 'surname' => 'Leone', 'date_of_birth' => '1996-04-15', 'email' => 'carmelo@dev.com', 'password' => Hash::make('password'),]);
        User::create(['name' => 'Giuseppe', 'surname' => 'Sciacca', 'date_of_birth' => '1992-10-31', 'email' => 'peppe@dev.com', 'password' => Hash::make('password'),]);
    }
}
