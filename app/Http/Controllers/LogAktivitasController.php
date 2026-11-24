<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::latest()->paginate(15);

        return view('home.log.index', compact('logs'));
    }
}
