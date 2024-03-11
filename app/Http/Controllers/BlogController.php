<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;


class BlogController extends Controller
{
    function home(Request $request) {
        $model = new Post;

        $builder = $this->applyUrlQuery($request, $model);
        $paginator = $this->getPaginatorResult($request, $builder);

        return Inertia::render('Home', [
            'posts' => $paginator,
            'categories' => $this->getCategories()
        ]);
    }

    function article(Post $post) {
        return Inertia::render('Article', [
            'post' => $post->toArray(true),
            'categories' => $this->getCategories(),
            'routeName' => 'home',
        ]);
    }

    function latest(Request $request) {
        $model = Post::where('top', true);
        $ids = $model->pluck('id')->toArray();

        $builder = $this->applyUrlQuery($request, $model);
        $paginator = $this->getPaginatorResult($request, $builder);

        return Inertia::render('Latest', [
            'posts' => $paginator,
            'categories' => $this->getCategories($ids),
        ]);
    }

    function latestArticle(Post $post) {
        $ids = Post::where('top', true)->pluck('id')->toArray();

        return Inertia::render('Article', [
            'post' => $post->toArray(true),
            'categories' => $this->getCategories($ids),
            'routeName' => 'latest',
        ]);
    }

    function tags() {
        return Inertia::render('Tags', [
            'categories' => Tag::all(),
        ]);
    }

    protected function getCategories(array $posts_ids = []) {
        if(!empty($posts_ids)) {
            $collection = Tag::whereHas('posts', function($query) use ($posts_ids) {
                $query->whereIn('id', $posts_ids);
            })->get();
        }else{
            $collection = Tag::all();
        }

        $arr = $collection->map(function($model) use ($posts_ids) {
            $arr = $model->toArray();
            $arr['posts_count'] = empty($posts_ids) ?
                $model->posts()->count() :
                $model->posts()->whereIn('id', $posts_ids)->count();
            return $arr;
        });

        return $arr;
    }

    protected function getPaginatorResult(Request $request, Builder|Post $builder) {
        return $builder->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString()
            ->through(function ($model) {
                return [
                    'id' => $model->id,
                    'path' => $model->path,
                    'file_alt' => $model->file_alt,
                    'title' => $model->title,
                    'text' => $model->description,
                    'created_at' => $model->created_at,
                    'categories' => $model->tags()->get()->toArray(),
                ];
            });
    }

    protected function applyUrlQuery (Request $request, Post|Builder $model) : Builder|Post {
        if($request->has('search')){
            $model = $model->whereFullText(['title', 'description', 'text_striped'], $request->search);
        }
        if($request->has('tag')){
            $model = $model->whereHas('tags', function($query) use ($request) {
                $query->where('title', $request->tag);
            });
        }

        return $model;
    }

}
