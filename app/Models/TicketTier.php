<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketTier extends Model
{
    protected $fillable = [
        'event_id', 'name', 'price', 'stock', 
        'start_date', 'end_date', 'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
