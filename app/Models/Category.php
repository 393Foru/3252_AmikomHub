<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // menandakan atribut: 1 kategori dapat memiliki banyak list event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
