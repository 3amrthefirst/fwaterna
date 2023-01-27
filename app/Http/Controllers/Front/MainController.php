<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Laywer;
use App\Models\Client;
use App\Models\Consult;
use App\Models\Article;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::first();
        $laywers = Laywer::all();
        $clients = Client::all();
        $consults = Consult::all();
        $articles = Article::all();
        $services = Service::all();
        return view('welcome', compact('settings','laywers','clients','consults','articles','services'));
    }
}
