<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats =ActivityLog::Latest()->paginate(10);
        return view('Admin.riwayat.index', compact('riwayats'));
    }

}
