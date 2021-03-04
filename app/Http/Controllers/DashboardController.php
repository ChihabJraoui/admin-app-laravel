<?php

namespace App\Http\Controllers;

use App\Client;
use App\Investment;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $clientsCount = Client::all()->count();

        $newInvestments = Investment::where('approved', false)->get();

        $data = [
            'clientsCount' => $clientsCount,
            'newInvestments' => $newInvestments
        ];

        return view('index', $data);
    }
}
