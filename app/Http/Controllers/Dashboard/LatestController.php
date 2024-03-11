<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use DataTables;

class LatestController extends Controller
{
    public function index() {
        return Inertia::render('Dashboard/Latest/Index', [
//            'posts' => $result,
            'posts' => Post::all(),
        ]);
    }

    public function posts() {
        $data = Post::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
//                ->addColumn('action', function($row){
//                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                    return $actionBtn;
//                })
//                ->rawColumns(['action'])
            ->make(true);
    }

    public function setTop(Request $request, Post $post) {
//        $post
    }
}
