<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class WelcomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::where("is_active", 1)->where("end_date", ">=", date('Y-m-d'))->paginate(10);
        return view("welcome", compact("blogs"));
    }
}
