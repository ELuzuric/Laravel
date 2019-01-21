@extends('layouts.app')

@section('content')
    <h1>Edit Activity</h1>
    <hr>
     <form action="{{url('activities', [$activity->id])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Activity Title</label>
        <input type="text" value="{{$activity->title}}" class="form-control" id="activityTitle"  name="title" >
      </div>
      <div class="form-group">
        <label for="description">Activity Description</label>
        <input type="text" value="{{$activity->description}}" class="form-control" id="activityDescription" name="description" >
      </div>
      <div class="form-group">
        <label for="condition">Condition Activity</label><br/>
        <label class="radio-inline"><input type="radio" name="condition" value="1" <?php echo ($condition=='Free')?'checked':'' ?>>Free</label>
        <label class="radio-inline"><input type="radio" name="condition" value="0" <?php echo ($condition=='Paying')?'checked':'' ?> >Paying</label>
      </div>
      <div class="form-group">
        <label for="recurrence">Recurrence Activity</label><br/>
        <label class="radio-inline"><input type="radio" name="recurrence" value="1" <?php echo ($recurrence=='Ponctual')?'checked':'' ?>>Punctual</label>
        <label class="radio-inline"><input type="radio" name="recurrence" value="0" <?php echo ($recurrence=='Recurrent')?'checked':'' ?> >Recurrent</label>
      </div>
      <div class="form-group">
        <label for="time">Time</label>
        <input type="text" class="form-control" id="activityTime" name="time">
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