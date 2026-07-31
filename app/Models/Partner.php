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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function penguruses()
    {
        return $this->hasMany(Pengurus::class);
    }

    public function ownedEvents()
    {
        return $this->hasMany(Event::class, 'partner_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

