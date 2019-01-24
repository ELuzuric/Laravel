@extends('layouts.app')


@section('content')

    <h1>Add New Activity From Idea</h1>
    <hr>
     <form action="/activities" method="post" enctype="multipart/form-data">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Activity Title</label>
        <input type="text" value="{{\App\Idea::select('title')->where('id',$_GET['idea'])->get()[0]->title}}" class="form-control" id="activityTitle"  name="title">
      </div>
      <div class="form-group">
        <label for="description">Activity Description</label>
        <input type="text" value="{{\App\Idea::select('description')->where('id',$_GET['idea'])->get()[0]->description}}" class="form-control" id="activityDescription" name="description">
      </div>
      <div class="form-group">
        <label for="date">Date</label>
        <input type="text" class="form-control" id="activityDate" name="date">
      </div>
      <div class="form-group">
        <label for="condition">Condition</label>
          <select class="form-control" name="condition">
            <option>Free</option>
            <option>Paying</option>
          </select>
      </div>
      <div class="form-group">
        <label for="recurrence">Recurrence</label>
          <select class="form-control" name="recurrence">
            <option>Ponctual</option>
            <option>Recurrent</option>
          </select>
      </div>
      <div class="form-group">
        <label for="description">Time</label>
        <input type="text" class="form-control" id="activityTime" name="time">
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