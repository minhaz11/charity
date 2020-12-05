<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
    	$option['menu'] = 'contact-us';
        return view('frontend.contact-us', $option);
    }

    public function saveContactMessage(Request $request)
    {
    	$request->validate([
		    'name' => 'required|max:50',
		    'email' => 'required|email|max:50',
		    'subject' => 'required|max:100',
		    'message' => 'required|max:255',
		]);

    	$option['menu'] = 'contact-us';
    	$contact = new ContactUs();
    	$contact->name = $request->name;
    	$contact->email = $request->email;
    	$contact->subject = $request->subject;
    	$contact->message = $request->message;
    	$contact->save();

    	\Session::flash('message', 'Message sent successfully, we will contact with you in shortly.');
        return redirect()->back();
    }
}
