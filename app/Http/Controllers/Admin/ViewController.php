<?php

namespace App\Http\Controllers\Admin;

use App\Models\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function show(View $view)
    {
        $apartment_views = View::
        join('apartments', 'apartment_id','=','apartments.id')
        ->where('apartment_id','=', $view->apartment_id)
        ->select('date_view')
        ->get();

        return view('admin.views.show', compact('apartment_views'));
    }
}
