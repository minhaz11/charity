<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * display all faqs
     * @return view page of blade
     */
    public function index()
    {
    	$option['menu'] = 'faqs';
        $option['faqs'] = Faq::all()->toArray();
        return view('admin.faq.index', $option);
    }

    /**
     * save FAQ
     * @param  Request $request 
     * @return view  
     */
    public function save(Request $request)
    {
        $option['menu'] = 'faqs';
        if ($request->isMethod('GET')) {
            return view('admin.faq.add-new', $option);
        }

        $request->validate([
            'title' => 'required|min:6|max:70',
            'content' => 'required',
            'status' => 'required'
        ]);

        $page = new Faq();
        $page->title = $request->title;
        $page->sort = 1;
        $page->status = $request->status;
        $page->content = $request->content;
        $page->save();

        \Session::flash('success', 'FAQ successfully saved');
        return redirect('faqs');
    }

    /**
     * update faq
     * @param  Request $request 
     * @param  integer  $id      
     * @return view           
     */
    public function update(Request $request, $id)
    {
        $option['menu'] = 'faqs';
        if ($request->isMethod('GET')) {
            $option['faq'] = Faq::find($id);
            return view('admin.faq.edit', $option);
        }

        $request->validate([
            'title' => 'required|min:6|max:70',
            'content' => 'required',
            'status' => 'required'
        ]);

        $page = Faq::find($request->id);
        $page->title = $request->title;
        $page->sort = $request->id;
        $page->status = $request->status;
        $page->content = $request->content;
        $page->save();

        \Session::flash('success', 'FAQ successfully saved');
        return redirect('faqs');
    }

    /**
     * delete faq using id
     * @param  int $id 
     * @return void     
     */
    public function delete($id)
    {
        $faq = Faq::find($id);
        $faq->delete();
        
        \Session::flash('success', 'FAQ successfully deleted');
        return redirect('faqs');
    }
}
