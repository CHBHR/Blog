<?php

namespace App\Controllers;

use App\Models\Article;

class BlogController extends Controller {

    public function welcome()
    {
        return $this->view('blog.welcome');
    }

    public function index()
    {
        $post = new Article($this->getDB());
        $posts = $post->getAll();

        return $this->view('blog.index', compact('posts'));
    }

    public function show(int $id)
    {
        $post = new Article($this->getDB());
        $post = $post->findById($id);

        return $this->view('blog.show', compact('post'));
    }
}