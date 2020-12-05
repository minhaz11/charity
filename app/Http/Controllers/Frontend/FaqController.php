<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Faq;

class FaqController extends Controller
{
    public function show()
    {
    	$option['menu'] = 'faqs';
        $option['faqs'] = Faq::where('status', 'active')->get();
        return view('frontend.faqs', $option);
    }
}
