<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Store;
use Illuminate\Support\Facades\Input;

class StoreController extends Controller
{
    /**
     * display all the stores
     * @return void
     */
    public function index()
    {
    	$option['menu'] = 'stores';
    	$option['stores'] = Store::all()->toArray();
    	return view('admin.store.index', $option);
    }

    /**
     * save store
     * @param  Request $request
     * @return void
     */
    public function save(Request $request)
    {
        $option['menu'] = 'stores';
        if ($request->isMethod('GET')) {
            return view('admin.store.add', $option);
        }

        $request->validate([
            'name' => 'required|min:3|max:50',
            'category_id' => 'required',
            'address' => 'required',
        ]);

        $store = new Store();
        $store->name          = $request->name;
        $store->category_id   = $request->category_id;
        $store->address       = $request->address;
        $store->country       = $request->country;
        $store->state         = $request->state;
        $store->city          = $request->city;
        $store->postal_code   = $request->postal_code;
        $store->telephone     = $request->telephone;
        $store->fax           = $request->fax;
        $store->mobile        = $request->mobile;
        $store->email         = $request->email;
        $store->website       = $request->website;
        $store->media         = $request->media;
        $store->default_media = $request->default_media;
        $store->description   = $request->description;
        $store->opening_hour  = $request->opening_hour;
        $store->closing_hour  = $request->closing_hour;
        $store->latitude      = $request->latitude;
        $store->longitude     = $request->longitude;
        $store->status        = $request->status;
        $store->external_link = $request->external_link;
        $store->save();

        \Session::flash('success', 'Store successfully saved');
        return redirect('stores');
    }
}
