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
            return redirect()->route('people.active')->with('success', 'ลบข้อมูลเรียบร้อย'); // ส่งข้อความแจ้งเตือนเมื่อสำเร็จ
        } catch (\Exception $e) {
            return redirect()->route('people.active')->with('error', 'เกิดข้อผิดพลาดในการลบข้อมูล'); // หากมีข้อผิดพลาด ให้รีไดเร็กต์กลับไปหน้าเดิม
        }
    }
}
