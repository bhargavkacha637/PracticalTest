<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 1) {
            $blogs = Blog::where("is_active", 1)->where("end_date", ">=", date('Y-m-d'))->paginate(10);
        } else {
            $blogs = Blog::where(["is_active" => 1, "created_by" => Auth::user()->id])->where("end_date", ">=", date('Y-m-d'))->paginate(10);
        }
        return view("blogs.index", compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("blogs.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|after_or_equal:start_date',
            'image' => $request->edit_id ? 'nullable|file|mimetypes:image/jpeg,image/png' : 'required|file|mimetypes:image/jpeg,image/png'
        ]);

        if ($request->edit_id) {
            //edit
            $blog = Blog::where("id", $request->edit_id)->first();
        } else {
            //create
            $blog = new Blog;
            $blog->created_by = Auth::user()->id;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fname =  $image->getClientOriginalName();
            $extention = $image->getClientOriginalExtension();
            $fileName = $fname . "-" . time() . "." . $extention;
            $image->move(public_path('uploads/blogs/'), $fileName);
            $blog->image = $fileName;
        }
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->start_date = $request->start_date;
        $blog->is_active = $request->is_active;
        $blog->end_date = $request->end_date;
        $blog->save();
        if ($request->edit_id) {
            //edit
            return redirect()->back()->with("success", "Blog Updated SuccessFully");
        } else {
            //create
            return redirect()->back()->with("success", "Blog Created SuccessFully");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view("blogs.form", compact("blog"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    }
}
