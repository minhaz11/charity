<?php

namespace App\Http\Controllers;

use App\Donate;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function donateStore(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'firstname'=> 'required|string',
            'lastname' => 'required|string',
            'email' => 'email|required',
            'phone' => 'required|numeric',
            'notes' => 'string'
        ]);

        Donate::create($request->all());
        return back()->with('success','Thanks for donate!!');
        
    }
}
