@extends('layouts.dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
            <h1>Modifica Post</h1>
      </div>
      <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="titolo">Titolo</label>
            <input type="text" name="title" class="form-control" id="titolo" placeholder="Inserici titolo post..." value="{{ old('title', $post->title) }}">
          </div>
          <div class="form-group">
            <label for="testo">Testo post</label>
            <textarea type="text" name="content" class="form-control" id="testo" placeholder="Iserisci testo post...">{{ old('content', $post->content) }}"</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Salva</button>
       </form>
      </div>
    </div>
  </div>
@endsection
