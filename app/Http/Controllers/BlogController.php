<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {

        return view('Home.layout');
    }
}
