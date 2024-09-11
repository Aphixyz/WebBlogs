<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
class ActivePeopleController extends Controller
{

    public function getCategory()
    {
        $categories = Category::all();

        return view('people.addblog', compact('categories'));
    }

    public function Getform()
    {
        $categories = Category::all();
        return view('people.addblog', compact('categories'));
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
        $blog->connection = 0 ;
        $blog->image = $imagePath ? 'images/' . $image->getClientOriginalName() : null;
        $blog->user_id = $peopleId;
        $blog->category_id = $validatedData['category_id'];
        $blog->save();
        return redirect()->back()->with('success', 'Blog created successfully!');
    }
}
