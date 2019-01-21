@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <hr>
     <form action="{{url('comments', [$comment->id])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Comment Title</label>
        <input type="text" value="{{$comment->title}}" class="form-control" id="commentTitle"  name="title" >
      </div>
      <div class="form-group">
        <label for="description">Comment Description</label>
        <input type="text" value="{{$comment->description}}" class="form-control" id="commentDescription" name="description" >
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