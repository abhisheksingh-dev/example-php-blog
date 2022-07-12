<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $files = File::files(resource_path("post"));
    $posts = [];

    foreach ($files as $file) {
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->date,
            $document->excerpt,
            $document->body(),
            $document->slug,
        );
    }
    // SymfonyYamlFrontMatterParser::parse_ini_file(resource_path('posts/my-fourth-post.html'));
    return view('posts', ['posts' => $posts]);
});

Route::get('post/{post}', function ($slug) {
    return view('post', [
        "post" => Post::find($slug),
    ]);
})->where('post', '[A-z_\-]+');

Route::get('/stock', function () {
    return view('stock');
});