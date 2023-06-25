<?php

namespace App\Http\Controllers\F;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UndanganController extends Controller
{
    public function index()
    {
        
        return view('front.index');
    }
}
