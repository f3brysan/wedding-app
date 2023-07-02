<?php

namespace App\Http\Controllers\B;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('back.dashboard');
    }
}
