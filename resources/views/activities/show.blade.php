@extends('layouts.app')

@section('content')
<h1>Showing your Activity : {{ $info_activity->title }}</h1>

<div class="jumbotron text-center">

    <p>
        <strong>Activity Title:</strong> {{ $info_activity->title }}<br>
        <strong>Description:</strong> {{ $info_activity->description }}<br>
        <strong>Date:</strong> {{ $info_activity->date }}<br>
        <strong>Condition:</strong> {{ $info_activity->condition }}<br>
        <strong>Recurrence:</strong> {{ $info_activity->recurrence }}<br>
        <strong>Time:</strong> {{ $info_activity->time }}<br>
        <img src="/images/{{$info_activity->URLimage}}" alt="" height="100px" width="150px" />
    </p>
    @can('isStudentsUnion')
    <a href="{{url('participates')}}"> <button type="submit" class="btn btn-primary">List of registered</button> </a>
    @endcan

    @can('isUser')

    <form action="/activities/{{$info_activity->id}}/show/imagestore" method="post" role="form" enctype="multipart/form-data">

     <button type="button" class="btn btn-warning">Share a photo
        <input type="file" name="file" id="file">
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </button>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>    


@endcan
@foreach($imagecomment as $image)
<img src="/images/{{$image->URLimage}}" alt="" height="100px" 
width="150px" /> 
<a href="{{ URL::to('comments/create') }}">
    <button type="button" class="btn btn-warning">Add Comment</button></i>
</a>
@endforeach
</div>
@endsection