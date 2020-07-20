@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 m-auto">
        <h1 class="mt-3 mb-3">Contact us : </h1>
        <form action="{{route('contact.store')}}" method="post">
            <div class="form-group">
              <input class="form-control" type="text" name="name" placeholder="Name">
            </div>
            <div class="form-group">
              <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" placeholder="Message" rows="8" cols="80"></textarea>
            </div>
            <div class="form-group">
              <input class="btn btn-success btn-sm" type="submit" value="Send message">
            </div>
          @csrf
        </form>
      </div>
    </div>
  </div>
@endsection
