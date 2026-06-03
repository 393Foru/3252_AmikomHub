<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo_url'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_partner');
    }
}

