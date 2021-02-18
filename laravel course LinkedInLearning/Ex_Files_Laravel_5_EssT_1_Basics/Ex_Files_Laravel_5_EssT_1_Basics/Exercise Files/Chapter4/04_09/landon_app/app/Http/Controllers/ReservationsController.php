<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    //
    public function bookRoom()
    {
        return view('reservations/bookRoom');
    }

    public function index($client_id, Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $client = new Client();
        $room = new Room();

        $data = [];
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['rooms'] = $rooms->getAvailableRoom($dateFrom, $dateTo);
        $data['client'] = $client->find($client_id)->first();
        return view('reservations/index', $data);


    }
}
