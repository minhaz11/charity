<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * to display all pages
     * @return void
     */
    public function index()
    {
    	$option['menu'] = 'pages';
        $option['pages'] = Page::all()->toArray();
        return view('admin.pages.index', $option);
    }

    /**
     * save page
     * @param  Request $request
     * @return void
     */
    public function save(Request $request)
    {
        $option['menu'] = 'pages';
        if ($request->isMethod('GET')) {
            return view('admin.pages.add-new', $option);
        }

        $request->validate([
		    'title' => 'required|min:3|max:15',
		    'status' => 'required'
		]);

    	$page = new Page();
    	$page->title = $request->title;
    	$page->slug = Page::slugify($request->title);
    	$page->status = $request->status;
    	$page->content = $request->content;
    	$page->save();

    	\Session::flash('success', 'Page successfully saved');
        return redirect('pages');
    }

    /**
     * update page
     * @param  Request $request 
     * @param  int  $id      
     * @return void
     */
    public function update(Request $request, $id)
    {
        $option['menu'] = 'pages';
        if ($request->isMethod('GET')) {
            $option['page'] = Page::find($id);
            return view('admin.pages.edit-page', $option);
        }

        $request->validate([
		    'title' => 'required|min:3|max:15',
		    'status' => 'required'
		]);

    	$page = Page::find($request->id);
    	$page->title = $request->title;
    	$page->slug = Page::slugify($request->title);
    	$page->status = $request->status;
    	$page->content = $request->content;
    	$page->save();

    	\Session::flash('success', 'Page successfully saved');
        return redirect('pages');
    }

    /**
     * delete page of a specific id
     * @param  int $id 
     * @return void  
     */
    public function delete($id)
    {
    	$page = Page::find($id);
		$page->delete();
        \Session::flash('success', 'Page successfully deleted');
        return redirect('pages');
    }
}
