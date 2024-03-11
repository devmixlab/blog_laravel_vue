<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Blog\Post\UpdateRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Requests\Blog\Post\StoreRequest;
use Illuminate\Support\Facades\File;
use Breadcrumbs;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = new Post;
        if($request->has('search')){
            $posts = $posts->whereFullText(['title', 'description', 'text_striped'], $request->search);
        }

        if($request->has('tag')){
            $posts = $posts->whereHas('tags', function($query) use ($request) {
                $query->where('title', $request->tag);
            });
        }

        if($request->has('top') && in_array($request->top, ['only_top','only_not_top'])){
            $top = $request->top == 'only_top';
            $posts = $posts->where('top', $top);
        }

        $perPage = (int)$request->get('perPage', 10);
//        if(!in_array($perPage, [10, 20, 50, 100]))
//            $perPage = 10;

        $result = $posts->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString()
            ->through(function ($model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'path' => $model->path,
                    'file_name' => $model->file_name,
                    'top' => (bool)$model->top,
                    'created_at' => $model->created_at,
                    'categories' => $model->tags()->get()->toArray()
                ];
            });

        return Inertia::render('Dashboard/Post/Index', [
            "paginator" => $result,
            "total" => Post::count(),
            "categories" => Tag::all(),
            "total_top" => Post::where('top', true)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = array_merge($request->validated(), [
            'text_striped' => strip_tags($request->text)
        ]);

        $model = Post::create($validated);
        $this->attachCategories($request, $model);

        if(!is_null($request->file)){
            $model->addFile($request->file, true);
        }

        return redirect()->route('dashboard.post.index')
            ->with('success', 'Post successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('Dashboard/Post/Edit', [
            'post' => $post->toArray(true),
            'categories' => $post->tags()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $validated = array_merge($request->validated(), [
            'text_striped' => strip_tags($request->text)
        ]);

        $post->update($validated);

        if($request->isMethod('put')){
            $success_message = 'Post data successfully updated.';
            $post->tags()->detach();
            $this->attachCategories($request, $post);
        }else{
            if(!empty($post->top)){
                $success_message = 'Post <b>`' . ucfirst($post->title) . '`</b> successfully added to Top posts.';
            }else{
                $success_message = 'Post <b>`' . ucfirst($post->title) . '`</b> successfully removed from Top posts.';
            }
        }

        $file_touched = $request->boolean('file_touched');
        if($file_touched === true) {
            if(is_null($request->file)){
                $post->deleteFile(true);
            }else{
                $post->addFile($request->file, true);
            }
        }

        return redirect()->back()->with('success', $success_message)
            ->with('custom_data', [
                "top" => $post->top
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $title = ucfirst($post->title);
        $post->tags()->detach();
        $post->delete();
        return back()->with('success', 'Post successfully deleted.<br><b>' . $title . '</b>');
    }

    /**
     * Remove the all resources from storage.
     */
    public function destroyAll()
    {
        $posts = Post::all();
        $posts->each(function($post) {
            $post->tags()->detach();
        });

        Post::truncate();

        return back()->with('success', 'All Posts successfully deleted.');
    }

    protected function attachCategories(Request $request, Post $post) {
        $categories = $request->get('categories', null);
        if(empty($categories))
            return;

        foreach ($categories as $category) {
            if(empty($category['title']))
                continue;

            $tag_model = Tag::where('title','like','%' . trim($category['title']) . '%')->first();
            if(empty($tag_model))
                $tag_model = Tag::create([
                    "title" => $category['title']
                ]);

            if($post->tags()->where('id', $tag_model->id)->count())
                continue;

            $post->tags()->attach($tag_model->id);
        }
    }

}
