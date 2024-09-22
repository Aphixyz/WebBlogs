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
        $blogs = Blog::with('category')->get();
        return view('admin.getBlogs', compact('blogs'));
    }
    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        return view('admin.editBlog', compact('blog', 'categories'));
    }

    public function updateBlog(Request $req, $id)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = Blog::findOrFail($id);

        // การอัปเดตค่าต่างๆ
        $blog->name = $validatedData['name'];
        $blog->description = $validatedData['description'];
        $blog->content = $validatedData['content'];
        $blog->category_id = $validatedData['category_id'];

        // การอัปเดตภาพ
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            if ($image->isValid()) {
                // ลบภาพเก่า (ถ้ามี)
                if ($blog->image) {
                    unlink(public_path($blog->image));
                }
                $imagePath = $image->move(public_path('images'), $image->getClientOriginalName());
                $blog->image = 'images/' . $image->getClientOriginalName();
            } else {
                return redirect()->back()->withErrors(['image' => 'Image upload failed.'])->withInput();
            }
        }

        $blog->save();
        return redirect()->route('admin.getblog')->with('success', 'บล็อกถูกอัปเดตเรียบร้อยแล้ว');
    }


    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.getblog')->with('success', 'บล็อกถูกลบเรียบร้อยแล้ว');
    }




    public function getCategory()
    {
        $categories = Category::all();
        return view('admin.getCategory', compact('categories'));
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

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    public function updateCategory(Request $req, $id)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];
        $category->save();

        return redirect()->route('admin.getCategory')->with('success', 'อัพเดทประเภทเรียบร้อยแล้ว');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.getCategory')->with('success', 'ลบประเภทเรียบร้อยแล้ว');
    }

}
