<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
        public function show($id)
    {
        return view('pages.event-detail');
    }

    public function checkout($id)
    {
        return view('pages.checkout');
    }
}
