<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //JOINO la tabella messages CON apartaments sull'id dell'appartamento (apartment_id), DOVE user_id di apartments è uguale all'utente loggato

        $messages = Message::join('apartments', 'apartment_id', '=', 'apartments.id')->where('apartments.user_id', '=', Auth::user('id')->id)->select('*', 'messages.id AS alias_message_id')->get();

        /* SELECT *,
         messages.id AS message_id
        FROM `messages`
        JOIN apartments ON apartment_id = apartments.id
        WHERE apartments.user_id = 5; */

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //dd($message); //messaggio 7
        //dd($message->apartment_id); 17 

        //prendi l'utente che ha ricevuto questo messaggio per l'appartamento (17)?
        //dobbiamo rispondere a questa domanda: l'utente autenticato è lo stesso di quello che ha ricevuto il messaggio?
        //in altre parole, chi è l'utente per l'appartamento (17) che ha ricevuto il messaggio?
        /* SELECT * 
        FROM users 
        JOIN apartments ON users.id = apartments.user_id 
        JOIN messages ON messages.apartment_id = apartments.id
        WHERE apartment_id= 17; */

        $recipient = User::join('apartments', 'users.id', '=', 'apartments.user_id')->join('messages', 'apartment_id', '=', 'apartments.id')->where('apartment_id', '=', $message->apartment_id)->select('users.id as user_id')->first();

        //dd($recipient->user_id); //5

        if (Auth::id() === $recipient->user_id) {
            //se l'utente loggato è lo stesso che ha ricevuto il messaggio allora:

            //prendo l'appartamento specifico che ha ricevuto il messaggio, così gli posso passare alcuni dati come il titolo per esempio
            $apartment = Apartment::where('apartments.id', '=', $message->apartment_id)->first();

            return view('admin.messages.show', compact('message', 'apartment'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return to_route('admin.messages.index')->with('message', 'message: ' . $message->title . ' Deleted');
    }
}
