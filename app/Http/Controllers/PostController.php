<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditOrgnization;

class PostController extends Controller
{
     // Show all posts
    public function index()
    {
        $audit_orgnizations = Post::all();
        return view('audit_orgnizations.index', compact('audit_orgnizations'));
    }
}
