@extends('layouts.app')

@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Activity Title</th>
              <th scope="col">Activity Description</th>
              <th scope="col">Date</th>
              <th scope="col">Condition</th>
              <th scope="col">Recurrence</th>
              <th scope="col">Time</th>
              <th scope="col">Created At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($activities as $activity)
            <tr>
              <th scope="row">{{$activity->id}}</th>
              <td><a href="/activities/{{$activity->id}}">{{$activity->title}}</a></td>
              <td>{{$activity->description}}</td>
              <td>{{$activity->date}}</td>
              <td>{{$activity->condition}}</td>
              <td>{{$activity->recurrence}}</td>
              <td>{{$activity->time}}</td>
              <td>{{$activity->created_at->toFormattedDateString()}}</td>

              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                @can('isStudentsUnion')
                  <a href="{{ URL::to('activities/' . $activity->id . '/edit') }}">
                  	<button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('activities', [$activity->id])}}" method="POST">
    					<input type="hidden" name="_method" value="DELETE">
   						<input type="hidden" name="_token" value="{{ csrf_token() }}">
   						<input type="submit" class="btn btn-danger" value="Delete"/>
              @endcan
              @can('isUser')
              <a href="participates/create">
                <button type="button" class="btn btn-warning">Submit</button>
              </a>&nbsp;
              @endcan
   				  </form>
              </div>
			</td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection