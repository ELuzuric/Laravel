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
      	<div class="container">
        	<div class="form-group">
          		<div class='input-group date' value="{{$activity->date}}" class="form-control" id="activityDate" name="date">
            		<input type='text' class="form-control" />
              		<span class="input-group-addon">
                		<span class="fa fa-calendar">
                		</span>
              		</span>
          		</div>
        	</div>
        </div>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker8').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
              });
            });
        </script>
      </div>
      <div class="form-group">
        <label for="condition">Condition</label>
        	<select class="form-control" name="condition" value="{{$activity->condition}}" class="form-control" id="activityCondition">
            	<option>Free</option>
            	<option>Paying</option>
            </select>
      </div>
      <div class="form-group">
        <label for="recurrence">Recurrence</label>
        	<select class="form-control" name="recurrence" value="{{$activity->recurrence}}" class="form-control" id="activityRecurrence">
            	<option>Ponctual</option>
            	<option>Recurrent</option>
          	</select>
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