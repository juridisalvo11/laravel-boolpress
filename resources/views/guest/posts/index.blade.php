@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Posts : </h1>
            <h2>Ciao {{$nome ?? ''}} </h2>
            <ul>
              @foreach ($posts as $post)
                <li>
                  <a href=" {{route('posts.show', ['slug' => $post->slug]) }}">
                    {{$post->title}}
                  </a>
                </li>
              @endforeach
            </ul>
            </div>
        </div>
    </div>
</div>
@endsection
