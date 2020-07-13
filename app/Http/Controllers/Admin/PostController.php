<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{

    public function index()
    {
      $posts = Post::all();
      return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
          'title' => 'required|max:255|unique:posts,title',
          'content' => 'required'
        ]);
        $dati_post = $request->all();
        $slug = Str::of($dati_post['title'])->slug('-');
        $dati_post['slug'] = $slug;
        $nuovo_post = new Post();
        $nuovo_post->fill($dati_post);
        $nuovo_post->save();
        return redirect()->route('admin.posts.index');
    }


    public function show($id)
    {
      $post = Post::find($id) ;
      if ($post) {
        return view('admin.posts.show', compact('post'));
      } else {
        return abort('404');
      }
    }


    public function edit($id)
    {
      $post = Post::find($id);
      if ($post) {
        return view('admin.posts.edit', compact('post'));
      } else {
        return abort('404');
      }
    }


    public function update(Request $request, $id)
    {
      $request->validate([
        'title' => 'required|max:255|unique:posts,title,' .$id,
        'content' => 'required'
      ]);
      $dati_post = $request->all();
      $slug = Str::of($dati_post['title'])->slug('-');
      $dati_post['slug'] = $slug;
      $post = Post::find($id);
      $post->update($dati_post);
      return redirect()->route('admin.posts.index');

    }


    public function destroy($id)
    {
      $post = Post::find($id) ;
      if ($post) {
        $post->delete();
        return redirect()->route('admin.posts.index');
      } else {
        return abort('404');
      }
    }
}
