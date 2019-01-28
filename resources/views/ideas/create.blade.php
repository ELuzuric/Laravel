@extends('layouts.app')

@section('content')
    <h1>Add New Idea</h1>
    <hr>
     <form action="/ideas" method="post" enctype="multipart/form-data">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Idea Title</label>
        <input type="text" class="form-control" id="ideaTitle"  name="title">
      </div>
      <div class="form-group">
        <label for="description">Idea Description</label>
        <input type="text" class="form-control" id="ideaDescription" name="description">
      </div>
      <div class="form-group">
        <label for="email">Email Student</label>
        <input type="text" value="{{Auth::user()->email}}" class="form-control" id="ideaDescription" name="email">
      </div>
      <div class="form-group"> 
      <label  for="file">Picture</label>
            <input type="file" name="file" id="file">

            <input type="hidden" value="{{ csrf_token() }}" name="_token">
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