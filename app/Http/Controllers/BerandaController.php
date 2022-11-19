<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data['nota'] = Nota::get();
        return view('welcome', $data);
    }
}
