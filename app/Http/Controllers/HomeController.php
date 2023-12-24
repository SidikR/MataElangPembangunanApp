<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $instansi = Instansi::all();

        return view('index', compact('instansi'));
    }
}
