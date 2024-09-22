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

    // public function Getform()
    // {
    //     $categories = Category::all();

    //     return view('people.addblog', compact('categories'));
    // }

    public function CreateBolg(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
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

    public function deleteData($id)
    {
        try {
            $blog = Blog::findOrFail($id); // ค้นหาบล็อกจาก ID
            if ($blog->image) { // ตรวจสอบว่ามีรูปภาพหรือไม่
                $imagePath = public_path($blog->image); // ตรวจสอบไฟล์ภาพในโฟลเดอร์ public
                if (file_exists($imagePath)) { // ถ้ามีไฟล์อยู่ ลบออก
                    unlink($imagePath);
                }
            }
            $blog->delete(); // ลบข้อมูลบล็อกออกจากฐานข้อมูล
            return redirect()->route('people.active')->with('success', 'ลบข้อมูลเรียบร้อย');
        } catch (\Exception $e) {
            return redirect()->route('people.active')->with('error', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }
    }

    public function editData($id)
    {
        $writer = Auth::user();
        $blogs = Blog::where('user_id', $writer->id)->get();
        $blogCount = $blogs->count();
        $viewCount = Blog::where('user_id', $writer->id)->sum('connection');
        $categories = Category::all();
        // ดึงข้อมูลบล็อกที่ต้องการแก้ไข
        $blogEdit = Blog::findOrFail($id);
        // ส่งข้อมูลไปที่ View เพื่อแสดงผลในฟอร์มแก้ไข
        return view('people.editForm', [
            'blogEdit' => $blogEdit,
            'writer' => $writer,
            'blogCount' => $blogCount,
            'viewCount' => $viewCount,
            'categories' => $categories
        ]);
    }

    public function updateData(Request $req, $id)
    {
        try {
            // Validate the request
            $validatedData = $req->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);
            // Find the blog by ID
            $blog = Blog::findOrFail($id);
            // Update the blog information from form input
            $blog->name = $validatedData['name'];
            $blog->category_id = $validatedData['category_id'];
            $blog->description = $validatedData['description'];
            $blog->content = $validatedData['content'];

            // Check if a new image is uploaded
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                if ($image->isValid()) {
                    // Delete the old image if it exists
                    if ($blog->image) {
                        $oldImagePath = public_path($blog->image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    // Move the new image to the images folder
                    $imagePath = $image->move(public_path('images'), $image->getClientOriginalName());
                    // Update the blog's image path
                    $blog->image = 'images/' . $image->getClientOriginalName();
                }
            }
            // Save the updated blog
            $blog->save();
            return redirect()->route('people.active')->with('success', 'บันทึกข้อมูลเรียบร้อย');
        } catch (\Exception $e) {
            return redirect()->route('people.active')->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
        }
    }
}
