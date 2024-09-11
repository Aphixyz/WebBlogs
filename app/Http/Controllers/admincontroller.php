<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


    public function adminCreateblog()
    {
        $categories = Category::all();

        return view('admin.addblogadmin', compact('categories'));
    }

    public function CreateBolg(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $peopleId = Auth::id();


        $imagePath = null;
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            if ($image->isValid()) {
                $imagePath = $image->move(public_path('images'), $image->getClientOriginalName());
            } else {
                return redirect()->back()->withErrors(['image' => 'Image upload failed.'])->withInput();
            }
        }

        $blog = new Blog();
        $blog->name = $validatedData['name'];
        $blog->description = $validatedData['description'];
        $blog->content = $validatedData['content'];
        $blog->connection = 0;
        $blog->image = $imagePath ? 'images/' . $image->getClientOriginalName() : null;
        $blog->user_id = $peopleId;
        $blog->category_id = $validatedData['category_id'];
        $blog->save();
        return redirect()->back()->with('success', 'Blog created successfully!');
    }

    public function getBlogForAdmin()
    {
        $datablog = blog::all();
        return $datablog;
    }

    public function getCategory()
    {
        $category = Category::all();
        return $category;
    }

    public function createCategory(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
        ]);
        $NewCategory = new Category();
        $NewCategory->name = $validatedData['name'];
        $NewCategory->save();
        return redirect()->back()->with('success', 'Blog created successfully!');
    }
}
