@extends('layouts.app')

@section('content')
    <h1>Add New comment</h1>
    <hr>
     <form action="/comments" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">comment Title</label>
        <input type="text" class="form-control" id="commentTitle"  name="title">
      </div>
      <div class="form-group">
        <label for="description">comment Description</label>
        <input type="text" class="form-control" id="commentDescription" name="description">
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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection