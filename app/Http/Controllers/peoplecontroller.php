<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class peoplecontroller extends Controller
{
    public function active()
    {
        return view('people.active');
    }
}
