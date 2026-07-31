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

    public function show(Partner $partner)
    {
        $partner->load(['ownedEvents' => function($q) {
            $q->latest()->take(3);
        }]);
        
        $reviews = $partner->reviews()->with('event')->latest()->paginate(5);
        $averageRating = $partner->reviews()->avg('rating') ?? 0;
        
        return view('partners.show', compact('partner', 'reviews', 'averageRating'));
    }
}
