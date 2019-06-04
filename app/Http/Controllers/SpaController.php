<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    /**
     * SpaController constructor. Requires auth for all routes for development
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return view('spa');
    }
}
