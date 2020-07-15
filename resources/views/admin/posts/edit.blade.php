@extends('layouts.dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
            <h1>Modifica Post</h1>
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
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
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <select class="form-control" id="categoria"name="category_id">
              <option value="">Seleziona categoria</option>
              @foreach ($categories as $category)
                <option
                  value="{{$category->id}}"
                  {{old('category_id', ($post->category->id ?? '')) == $category->id ? 'selected' : ''}}>
                  {{$category->name}}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            Tag :
            @foreach ($tags as $tag)
              <div class="form-check form-check-inline">
                <label class="form-check-label" for="inlineCheckbox1">
                  <input
                    @if ($errors->any())
                      {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                    @else
                      {{$post->tags->contains($tag) ? 'checked' : ''}}
                    @endif
                    class="form-check-input"
                    name="tags[]"
                    type="checkbox" id="inlineCheckbox1"
                    value="{{$tag->id}}">
                    {{$tag->name}}
                </label>
              </div>
            @endforeach
          </div>
          <button type="submit" class="btn btn-primary">Salva</button>
       </form>
      </div>
    </div>
  </div>
@endsection
