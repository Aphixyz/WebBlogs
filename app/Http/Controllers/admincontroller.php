<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\Category;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
    public function active()
    {
        return view('admin.active');
    }
    public function activeAddCategory()
    {
        return view('admin.addcategory');
    }


    
    public function getBlogForAdmin(){
        $datablog = blog::all();
        return $datablog ; 
    }

    public function getCategory(){
        $category = Category::all();
        return $category ; 
    }

    public function createCategory(Request $req){
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
        ]);
        $NewCategory = new Category();
        $NewCategory->name = $validatedData['name'];
        $NewCategory->save();
        return redirect()->back()->with('success', 'Blog created successfully!');
    }
}
