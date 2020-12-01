<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function postsManagement()
    {
        # On retourne à la vue la liste des articles de la base
        return view('admin.posts', [
            'posts' => Post::all()
        ]);
    }
}
