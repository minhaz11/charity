<?php

namespace App\Http\Controllers\Admin;

use App\Donate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function allDonations()
    {
        $option['menu'] = 'donations';
        $donations = Donate::latest()->get();
        return view('admin.donations.allDonations',compact('donations','option'));
    }

    public function markAsRecieved($id)
    {
       $donation = Donate::findOrFail($id);
       $donation->status = 1;
       $donation->update();
       return back()->with('success','Mark as recieved successfully');
    }
}
