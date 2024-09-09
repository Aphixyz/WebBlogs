<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivePeopleController extends Controller
{
    public function Getform()
    {
        return view('people.addblog');
    }
}
