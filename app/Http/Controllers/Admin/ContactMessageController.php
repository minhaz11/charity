<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ContactUs;

class ContactMessageController extends Controller
{
    /**
     * display all contact message of company submited by guest
     * @return void 
     */
    public function index()
    {
    	$option['menu'] = 'contact-message';
        $option['contacts'] = ContactUs::all()->toArray();
        return view('admin.message.index', $option);
    }

    /**
     * deleteContact message
     * @param  int $id 
     * @return void
     */
    public function deleteContact($id)
    {
    	$contact = ContactUs::find($id);
		$contact->delete();
        return redirect()->back()->with('success', 'Contact successfully deleted');
    }
}
