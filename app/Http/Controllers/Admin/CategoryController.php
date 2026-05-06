<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan halaman utama kategori
     */
    public function index()
    {
        // Mengarahkan ke file resources/views/admin/categories/index.blade.php
        return view('admin.categories.index');
    }
}