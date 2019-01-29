@extends('layouts.app')

@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">comment Title</th>
              <th scope="col">comment Description</th>
              <th scope="col">Created At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($comments as $comment)
            <tr>
              <th scope="row">{{$comment->id}}</th>
              <td><a href="/comments/{{$comment->id}}">{{$comment->title}}</a></td>
              <td>{{$comment->description}}</td>
              <td>{{$comment->created_at->toFormattedDateString()}}</td>
              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('comments/' . $comment->id . '/edit') }}">
                  	<button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('comments', [$comment->id])}}" method="POST">
    					<input type="hidden" name="_method" value="DELETE">
   						<input type="hidden" name="_token" value="{{ csrf_token() }}">
   						<input type="submit" class="btn btn-danger" value="Delete"/>
   				  </form>
              </div>
			</td>
            </tr>
            
          </tbody>
        </table>

        <div class="post-heading">
                    <div class="pull-left image">
                        <!--<img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image"> -->
                    </div>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b>{{$comment->title}}</b></a>
                            is the title
                        </div>
                        <h6 class="text-muted time">{{$comment->created_at->toFormattedDateString()}}</h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p>{{$comment->description}}</p>
                    <div class="stats">
                        <a href="#" class="btn btn-default stat-item">
                             <a href="{{ URL::to('comments/' . $comment->id . '/edit') }}">
                    <button type="button" class="btn btn-warning">Edit</button></i>
                        </a>
                        <a href="#" class="btn btn-default stat-item">
                             <form action="{{url('comments', [$comment->id])}}" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" class="btn btn-danger" value="Delete"/>
            </form></i>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
@endsection
