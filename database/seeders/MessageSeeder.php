<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = config('data.messages');
        foreach ($messages as $message) {
            $newMessage = new Message();
            $newMessage->name = $message["name"];
            $newMessage->surname = $message["surname"];
            $newMessage->email = $message["email"];
            $newMessage->message = $message["message"];
            $newMessage->apartment_id = $message["apartment_id"];
            $newMessage->save();
        }
    }
}
