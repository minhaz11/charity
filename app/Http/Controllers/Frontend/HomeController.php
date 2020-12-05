<?php

namespace App\Http\Controllers\Frontend;

use App\Campaign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $option['menu'] = 'home';
        $campaigns = Campaign::latest()->take(4)->get();
        return view('frontend.home', compact('campaigns'));
    }
}
