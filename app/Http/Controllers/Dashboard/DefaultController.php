<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class DefaultController extends Controller
{
    function index() {
        return Inertia::render('Dashboard', [
            'posts' => [
                'total' => Post::count(),
                'top_total' => Post::where('top', true)->count(),
                'not_top_total' => Post::where('top', false)->count(),
            ],
            'categories' => [
                'total' => Tag::count(),
                'with_posts_total' => Tag::whereHas('posts')->count(),
                'without_posts_total' => Tag::doesntHave('posts')->count(),
            ]
        ]);
    }
}
