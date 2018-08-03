<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrawController extends Controller
{
    //
    public function index()
    {
        return view('Event/draw');
    }
}
