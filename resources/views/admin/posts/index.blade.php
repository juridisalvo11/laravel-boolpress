@extends('layouts.dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
            <h1>Posts : </h1>
          <a class="btn btn-success" href="{{ route('admin.posts.create')}}">Nuovo Post</a>
      </div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Titolo</th>
              <th>Slug</th>
              <th>Categorie</th>
              <th>Azioni</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>{{$post->category->name ?? '-'}}</td>
                <td>
                  <a class="btn btn-info btn-small" href="{{route('admin.posts.show', ['post' => $post->id])}}">Dettagli</a>
                  <a class="btn btn-warning btn-small" href="{{route('admin.posts.edit', ['post' => $post->id])}}">Modifica</a>
                  <form class="d-inline" action="{{ route('admin.posts.destroy', ['post' => $post->id])}} " method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger btn-small" type="submit" value="Elimina">
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">Non è stato trovato alcun post</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
