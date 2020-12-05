<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function allCampaigns()
    {
        $campaings = Campaign::latest()->get();
        return view('admin.campaings.allCampaigns',compact('campaings'));
    }

    public function create(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:40',
            'target_amount'=>'required|numeric',
            'short_desc' => 'required|string|max:80',
            'description' => 'required|string|min:130',
            'image' => 'required|image',

        ]);

       $campaign = new Campaign();
       $campaign->title = $request->title;
       $campaign->target_amount = $request->target_amount;
       $campaign->short_desc = $request->short_desc;
       $campaign->description = $request->description;
       if ($request->hasFile('image')) {
           $campaign->image = uploadImage($request->image,'public/campaigns/images/',null,null,'250x190' );
       }
       $request->status ? $campaign->status = 1 : $campaign->status = 0;
       $campaign->save();
       return back()->with('success','Campaign Created successfully');
    }
}
