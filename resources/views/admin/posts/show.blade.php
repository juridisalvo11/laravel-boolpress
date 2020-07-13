@extends('layouts.dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
            <h1>Dettagli post : </h1>
      </div>
      <div class="">
        <strong>Titolo : </strong>
        <p>{{$post->title}}</p>
      </div>
      <div class="">
        <strong>Contenuto : </strong>
        <p>{{$post->content}}</p>
      </div>
      <div class="">
        <strong>Slug : </strong>
        <p>{{$post->slug}}</p>
      </div>
      <div class="">
        <strong>Data creazione : </strong>
        <p>{{$post->created_at}}</p>
      </div>
      <div class="">
        <strong>Data ultima modifica : </strong>
        <p>
        {{$post->updated_at}}</p>
      </div>
      </div>
    </div>
  </div>
@endsection
