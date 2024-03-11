<?php // routes/breadcrumbs.php

use App\Models\Post;

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('article', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('home');
    $trail->push(ucfirst($post->title), route('article', ["post" => $post->id]));
});

Breadcrumbs::for('latest', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push("Top latest", route('latest'));
});

Breadcrumbs::for('latest.article', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('latest');
    $trail->push(ucfirst($post->title), route('article', ["post" => $post->id]));
});

Breadcrumbs::for('tags', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push("Categories", route('tags'));
});

Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

Breadcrumbs::for('dashboard.category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Categories', route('dashboard.category.index'));
});

Breadcrumbs::for('dashboard.category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.category.index');
    $trail->push('Create new category', route('dashboard.category.create'));
});

Breadcrumbs::for('dashboard.category.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('dashboard.category.index');
    $trail->push('Edit category', route('dashboard.category.edit', [
        "tag" => $category
    ]));
});

Breadcrumbs::for('dashboard.post.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Posts', route('dashboard.post.index'));
});

Breadcrumbs::for('dashboard.post.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.post.index');
    $trail->push('Create new post', route('dashboard.post.create'));
});

Breadcrumbs::for('dashboard.post.edit', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('dashboard.post.index');
    $trail->push('Edit post', route('dashboard.post.edit', [
        "post" => $post->id
    ]));
});

// Home > Blog
//Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//    $trail->parent('home');
//    $trail->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category));
//});
