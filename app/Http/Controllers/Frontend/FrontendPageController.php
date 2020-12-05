<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Page;

class FrontendPageController extends Controller
{
    public function show($slug)
    {
    	$option['menu'] = 'pages';
        $option['page'] = Page::where('slug', $slug)->first();
        if ($option['page'] === null) {
        	return redirect()->back();
        }
        return view('frontend.pages', $option);
    }
}
