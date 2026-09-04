<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeries = Galeri::latest()->paginate(6);

        return view('galery.index', compact('galeries'));
    }
}