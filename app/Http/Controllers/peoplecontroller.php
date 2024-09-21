<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class PeopleController extends Controller
{
    public function active()
    {
        $id = auth()->id();
        $blogs = Blog::where('user_id', $id)->get();
        $blogCount = $blogs->count();
        $viewCount = Blog::where('user_id', Auth::id())->sum('connection');
        // $blogs = blog::all();
        return view('people.active', compact(
            'blogs',
            'blogCount',
            'viewCount'
        ));
    }

    public function getBlog()
    {
        $id = auth()->id();
        $blogs = Blog::where('user_id', $id)->get();
        $blogCount = $blogs->count();
        $viewCount = Blog::where('user_id', Auth::id())->sum('connection');
        $categories = Category::all();
        // $blogs = blog::all();
        return view('people.addblog', compact(
            'blogs',
            'blogCount',
            'viewCount',
            'categories'
        ));
    }
}
