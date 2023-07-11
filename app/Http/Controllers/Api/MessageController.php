<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();

        //valida richiesta
        $validator = Validator::make($data, [
            'apartment_id' => 'exists:apartments,id',
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'email' => 'required|email|max:150',
            'message' => 'required',
        ]);
        // controlla che la validazione vada a buon fine
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        //salva i dati nel db
        $newMessage = new Message();
        $newMessage->fill($data);
        $newMessage->save();

        //return success response
        return response()->json([
            'success' => true
        ]);
    }
}
