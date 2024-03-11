<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Blog\Category\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->wantsJson() && $request->has('all')) {
            $collection = Tag::all()->map(function ($model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'created_at' => $model->created_at,
                    'posts_count' => $model->posts()->count(),
                ];
            });
            return response()->json($collection);
        }

        $model = new Tag;
        if($request->has('search')){
            $model = $model->where('title','like','%' . $request->search . '%');
        }

        if($request->has('with_post') && in_array($request->with_post, [
            'with', 'without'
        ])){
            if($request->with_post == 'with'){
                $model = $model->whereHas('posts');
            }else{
                $model = $model->doesntHave('posts');
            }
        }

        $perPage = (int)$request->get('perPage', 10);
//        if(!in_array($perPage, [10, 20, 50, 100]))
//            $perPage = 10;

        $paginator = $model->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString()
            ->through(function ($model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'created_at' => $model->created_at,
                    'posts_count' => $model->posts()->count(),
                ];
            });

//        dd($result->links());

        if($request->wantsJson())
            return response()->json($paginator);

        return Inertia::render('Dashboard/Categories/Index', [
            "paginator" => $paginator,
            "total" => Tag::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $model = Tag::create($request->validated());
        return redirect()->route('dashboard.category.index')
            ->with('success', 'Category successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
//        dd($tag->toArray());
//        exit;

        return Inertia::render('Dashboard/Categories/Edit', [
            'resource' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return redirect()->back()->with('success', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $title = $tag->title;
        $tag->posts()->detach();
        $tag->delete();
        return back()->with('success', 'Tag <b>`' . $title . '`</b> successfully deleted.');
    }

    /**
     * Remove the all resources from storage.
     */
    public function destroyAll()
    {
        $tags = Tag::all();
        $tags->each(function($tag) {
            $tag->posts()->detach();
        });

        Tag::truncate();

        return back()->with('success', 'All Categories successfully deleted.');
    }
}
