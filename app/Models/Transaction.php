<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'event_id', 'order_id', 'customer_name', 'customer_email',
        'customer_phone', 'total_price', 'status', 'snap_token',
        'ticket_tier_id', 'voucher_id', 'discount_amount', 'quantity'
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function ticketTier()
    {
        return $this->belongsTo(TicketTier::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
