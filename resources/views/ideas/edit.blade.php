@extends('layouts.app')

@section('content')
    <h1>Edit Idea</h1>
    <hr>
     <form action="{{url('ideas', [$idea->id])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Idea Title</label>
        <input type="text" value="{{$idea->title}}" class="form-control" id="ideaTitle"  name="title" >
      </div>
      <div class="form-group">
        <label for="description">Idea Description</label>
        <input type="text" value="{{$idea->description}}" class="form-control" id="ideaDescription" name="description" >
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