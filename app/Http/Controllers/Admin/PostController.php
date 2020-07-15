<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{

    public function index()
    {
      $posts = Post::with('category', 'tags')->get();
      return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
          'categories' => $categories,
          'tags' => $tags
        ];
        return view('admin.posts.create', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
          'title' => 'required|max:255|unique:posts,title',
          'content' => 'required'
        ]);

        $dati_post = $request->all();
        $slug = Str::of($dati_post['title'])->slug('-');
        $slug_iniziale = $slug;
        $slug_trovato = Post::where('slug', $slug)->first();
        $contatore = 0;
        while($slug_trovato) {
          $contatore++;
          $slug = $slug_iniziale . '-' . $contatore;
          $slug_trovato = Post::where('slug', $slug)->first();
        }
        $dati_post['slug'] = $slug;

        $nuovo_post = new Post();
        $nuovo_post->fill($dati_post);
        $nuovo_post->save();
        if(!empty($dati_post['tags'])) {
          $nuovo_post->tags()->sync($dati_post['tags']);
        }
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
      $tags = Tag::all();
      if ($post) {
        $categories = Category::all();
        $data = [
          'post' => $post,
          'categories' => $categories,
          'tags' => $tags
        ];
        return view('admin.posts.edit', $data);
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
      $slug_iniziale = $slug;
      $slug_trovato = Post::where('slug', $slug)->first();
      $contatore = 0;
      while($slug_trovato) {
        $contatore++;
        $slug = $slug_iniziale . '-' . $contatore;
        $slug_trovato = Post::where('slug', $slug)->first();
      }
      $dati_post['slug'] = $slug;

      $post = Post::find($id);
      $post->update($dati_post);
      if(!empty($dati_post['tags'])) {
        $post->tags()->sync($dati_post['tags']);
      } else {
        $post->tags()->detach();
      }

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
