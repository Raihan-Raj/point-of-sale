<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboardPage()
    {
        return view('backpage.dashboard-page');
    }
}
