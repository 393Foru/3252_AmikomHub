<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::withCount('events')->latest()->paginate(12);
        return view('partners.index', compact('partners'));
    }
}
