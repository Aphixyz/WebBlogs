<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Category;
use App\Models\User;


class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $blogs = Blog::paginate(3);
        $latest = Blog::orderBy('id', 'desc')->take(3)->get(); //แสดง 3 บทความล่าสุด
        $popular = Blog::orderBy('connection', 'desc')->take(3)->get(); // บทความยอดนิยมมากที่สุด
        $suggestion = Blog::orderBy('connection', 'asc')->take(3)->get(); // บทความยอดนิยมน้อยที่สุด
        return view('Home.index', compact('categories', 'blogs', 'latest', 'popular', 'suggestion'));
    }

    public function blogDetail($id)
    {
        $categories = Category::all();
        $blog = Blog::findOrFail($id); // ดึงข้อมูลบล็อกจากฐานข้อมูลตาม ID ที่ส่งเข้ามา
        $latest = Blog::orderBy('id', 'desc')->take(0)->get();
        $blog->connection += 1; // เพิ่มจำนวนการเข้าชม
        $blog->save();
        $blog->refresh(); // บันทึกการเปลี่ยนแปลง
        $popular = Blog::orderBy('connection', 'desc')->take(3)->get(); // บทความยอดนิยมมากที่สุด
        $suggestion = Blog::orderBy('connection', 'asc')->take(3)->get(); // บทความยอดนิยมน้อยที่สุด
        return view('Home.blogDetail', compact('categories', 'blog', 'latest', 'popular', 'suggestion'));
    }

    public function searchCategory($category_id)
    {
        $categories = Category::all();
        $blogs = Blog::where('category_id', $category_id)->paginate();
        $latest = Blog::orderBy('id', 'desc')->take(0)->get();
        $popular = Blog::orderBy('connection', 'desc')->take(3)->get();
        $suggestion = Blog::orderBy('connection', 'asc')->take(3)->get();
        $categoryName = Category::findOrFail($category_id)->name;
        return view('Home.searchCategory', compact('categories', 'blogs', 'latest', 'popular', 'suggestion', 'categoryName'));
    }

    public function searchUser($user_id)
    {
        $categories = Category::all();
        $blogs = Blog::where('user_id', $user_id)->paginate();
        $latest = Blog::orderBy('id', 'desc')->take(0)->get();
        $popular = Blog::orderBy('connection', 'desc')->take(3)->get();
        $suggestion = Blog::orderBy('connection', 'asc')->take(3)->get();
        $userName = User::findOrFail($user_id)->name;
        return view('Home.searchUser', compact('categories', 'blogs', 'latest', 'popular', 'suggestion', 'userName'));
    }
}
