<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
class ActivePeopleController extends Controller
{
    public function Getform()
    {
        return view('people.addblog');
    }

    public function getCategory()
    {
        $categories = Category::all();

        return view('people.addblog', compact('categories'));
        //return $categories;
    }

    public function CreateBolg(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string|max:255',
            'connection' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $peopleId = Auth::id();
        if ($req->hasFile('image')) {
            $imagePath = $req->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $blog = new Blog();
        $blog->name = $validatedData['name'];
        $blog->description = $validatedData['description'];
        $blog->content = $validatedData['content'];
        $blog->connection = $validatedData['connection'];
        $blog->image = $imagePath;
        $blog->user_id = $peopleId;
        $blog->save();
        return redirect()->back()->with('success', 'Blog created successfully!');
    }
}
