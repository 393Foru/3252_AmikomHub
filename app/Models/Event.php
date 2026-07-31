<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'partner_id',
        'title',
        'description',
        'date',
        'location',
        'price',
        'stock',
        'poster_path'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // menandakan atribut: 1 event harus terpaut pada satu wujud kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'event_partner');
    }

    public function owner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
