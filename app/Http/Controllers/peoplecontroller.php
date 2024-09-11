<?php

namespace App\Http\Controllers;
use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    public function active()
    {
        $id = auth()->id();
        $blogs = Blog::where('user_id', $id)->get();

        return view('people.active', compact(
            'blogs'
        ));
    }
}
