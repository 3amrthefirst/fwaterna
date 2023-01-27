<?php

namespace App\Http\Controllers\Admin;

use App\Charts\LineChart;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public $bgColorsStock = [
    //     'rgb(54, 162, 235)',
    //     'rgb(255, 99, 132)',
    //     'rgb(255, 159, 64)',
    //     'rgb(153, 102, 255)',
    //     'rgb(255, 205, 86)',
    //     'rgb(75, 192, 192)',
    //     'rgb(201, 203, 207)',
    // ];

    //
    public function index(Request $request)
    {
        $line1 = $this->contactsPerMonth($request);
        $line2 = $this->clientsPerMonth($request);
        return view('admin.layouts.home',compact('line1','line2'));
    }

    private function contactsPerMonth($request)
    {
        $contacts = Contact::where(function ($query) use($request){

        })->selectRaw('count(id) as total_contacts,DATE_FORMAT(created_at,"%Y-%m") as month')
            ->groupBy('month')->orderBy('month','asc')->get();
        $contactsMonthly = new LineChart;
        $contactsMonthly
            ->labels($contacts->pluck('month')->toArray())
            ->dataset('عدد اﻹستشارات شهريا','line',$contacts->pluck('total_contacts')->toArray())
            ->color("rgb(54, 162, 235)")->backgroundColor("rgb(54, 162, 235)")->fill(false);
        return $contactsMonthly;
    }

    private function clientsPerMonth($request)
    {
        $clients = Client::where(function ($query) use($request){

        })->selectRaw('count(id) as total_clients,DATE_FORMAT(created_at,"%Y-%m") as month')
            ->groupBy('month')->orderBy('month','asc')->get();
        $clientsMonthly = new LineChart;
        $clientsMonthly
            ->labels($clients->pluck('month')->toArray())
            ->dataset('عدد العملاء شهريا','line',$clients->pluck('total_clients')->toArray())
            ->color("rgb(255, 99, 132)")->backgroundColor("rgb(255, 99, 132)")->fill(false);
        return $clientsMonthly;
    }


}
