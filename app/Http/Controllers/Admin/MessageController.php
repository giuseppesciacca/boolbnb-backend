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

        //dd($messages);

        //dd(Auth::user('id'));

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
        //$apartment = Apartment::select('title')->orderByDesc('id')->get();
        //$apartment = Apartment::where('user_id', Auth::user()->id)->orderByDesc('id');
        $apartment_title = Apartment::join('messages', 'apartment_id', '=', 'apartments.id')->get();

        //dd($apartment_title[0]->title);

        return view('admin.messages.show', compact('apartment_title', 'message'));
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
