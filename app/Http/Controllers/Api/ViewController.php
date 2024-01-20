<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViewController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();

        //valida richiesta
        $validator = Validator::make($data, [
           'apartment_id' =>'exists:apartments,id|numeric',
           'ip_address'=>['required', 'ipv4', 'unique:'. View::class],
           'date_view'=>'required|date',
        ]);
        // controlla che la validazione vada a buon fine
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        //salva i dati nel db
        $newMessage = new View();
        $newMessage->fill($data);
        $newMessage->save();

        //return success response
        return response()->json([
            'success' => true
        ]);
    }
}
