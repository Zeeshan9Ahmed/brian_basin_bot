<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($name)
    {

        $page = Content::where('slug',$name)->first();
        return view('Admin.pages.index', compact('page'));
    }

    public function update(Request $request)
    {
        $page = Content::findOrFail($request->id);
        
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();
        return redirect()->back();
        // return $page;

    }
}
