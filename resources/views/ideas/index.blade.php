@extends('layouts.app')

@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Idea Title</th>
              <th scope="col">Idea Description</th>
              <th scope="col">Email Student</th>
              <th scope="col">Photo</th>
              <th scope="col">Created At</th>
              @can('isStudentsUnion')
              <th scope="col">Action</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @foreach($ideas as $idea)
            <tr>
              <!-- <th scope="row">{{$idea->id}}</th> -->
              <td><a href="/ideas/{{$idea->id}}">{{$idea->title}}</a></td>
              <td>{{$idea->description}}</td>
              <td>{{$idea->email}}</td>
              <td><img src="/images/{{$idea->URLimage}}" alt="" height="100px" 
              width="150px" /></td>
              <td>{{$idea->created_at->toFormattedDateString()}}</td>
              <td>
              @can('isStudentsUnion')
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('ideas/' . $idea->id . '/edit') }}">
                  	<button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('ideas', [$idea->id])}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-danger" value="Delete"/>
   				        </form>&nbsp;
                  <a href="{{ URL::to('activities/ideastudent?idea='.$idea->id.$idea->email) }}">
                    <button type="button" class="btn btn-success">Choose this idea</button>
                  </a>
                  
              </div>
              @endcan
			        </td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection