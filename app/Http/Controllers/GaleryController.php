<?php

namespace App\Http\Controllers;

use App\Models\Galery;

class GaleryController extends Controller
{
    public function index()
    {
        $galeries = Galery::latest()->paginate(6);

        return view('galery.index', compact('galeries'));
    }
}