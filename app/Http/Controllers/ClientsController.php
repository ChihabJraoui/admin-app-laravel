<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function getClients(Request $request)
    {
        $query = Client::where('approved', true);

        if($request->has('search'))
        {
            $query->where('fullname', 'like', '%'. $request->get('search') .'%')
                ->orWhere('email', 'like', '%'. $request->get('search') .'%');
        }

        $clients = $query->paginate(10);

        $data = [
            'clients' => $clients
        ];

        return view('clients.index', $data);
    }
}
