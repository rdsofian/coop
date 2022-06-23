<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:dashboard-list', ['only' => ['index','show']]);
    }

    public function index()
    {
        return view('dashboard');
    }
}
