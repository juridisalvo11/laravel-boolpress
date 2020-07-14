@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
                <h1>{{$post->title}}</h1>
                <p>{{$post->content}}</p>
                <p>Categoria : {{$post->category->name ?? 'nessuna categoria'}}</p>
        </div>
    </div>
</div>
@endsection
