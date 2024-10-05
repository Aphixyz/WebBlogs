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
        $blogs = Blog::all(); // ดึงข้อมูลบทความทั้งหมด
        return view('admin.active', compact('blogs'));
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
            $blog = Blog::findOrFail($id);

            // ตัวเลือก: ลบไฟล์ภาพหากมีอยู่
            if ($blog->image) {
                $oldImagePath = public_path($blog->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // ลบภาพเก่า
                }
            }

            $blog->delete(); // ลบข้อมูลบล็อกจากฐานข้อมูล

            return response()->json(['success' => 'บล็อกถูกลบสำเร็จ']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'เกิดข้อผิดพลาดในการลบบล็อก: ' . $e->getMessage()], 500);
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
        return view('admin.editForm', [
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
            $validatedData = $req->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);

            $blog = Blog::findOrFail($id);

            if (!$blog) {
                return;
            }

            // อัปเดตรูปภาพถ้ามีการอัปโหลดรูปใหม่
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                if ($image->isValid()) {
                    if ($blog->image) {
                        $oldImagePath = public_path($blog->image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath); // ลบรูปเดิมถ้ามี
                        }
                    }
                    $imagePath = $image->move(public_path('images'), $image->getClientOriginalName());
                    $blog->image = 'images/' . $image->getClientOriginalName();
                }
            }

            $blog->name = $validatedData['name'];
            $blog->category_id = $validatedData['category_id'];
            $blog->description = $validatedData['description'];
            $blog->content = $validatedData['content'];
            $blog->save(); // บันทึกข้อมูลลงฐานข้อมูล

            return redirect()->route('admin.active')->with('success', 'บันทึกข้อมูลเรียบร้อย');
        } catch (\Exception $e) {
            return redirect()->route('admin.active')->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
        }
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
