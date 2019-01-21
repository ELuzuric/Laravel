@extends('layouts.app')

@section('content')
    <h1>Add New Idea</h1>
    <hr>
     <form action="/ideas" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Idea Title</label>
        <input type="text" class="form-control" id="ideaTitle"  name="title">
      </div>
      <div class="form-group">
        <label for="description">Idea Description</label>
        <input type="text" class="form-control" id="ideaDescription" name="description">
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