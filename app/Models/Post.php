<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $date;
    public $excerpt;
    public $title;
    public $body;

    public function __construct($title, $date, $excerpt, $body, $slug)
    {
        $this->title = $title;
        $this->date = $date;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        $files = File::files(resource_path("post/"));
        return array_map(fn ($file) => $file->getContents(), $files);
    }

    public static function find($slug)
    {
        if (!file_exists($path = resource_path("post/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }
        $document = YamlFrontMatter::parseFile($path);
        $post = new Post(
            $document->title,
            $document->date,
            $document->excerpt,
            $document->body(),
            $document->slug,
        );
        return $post;
        // return  cache()->remember(
        //     "posts.{$slug}",
        //     now()->addSeconds(5),
        //     fn () => $post,
        // );
    }
}