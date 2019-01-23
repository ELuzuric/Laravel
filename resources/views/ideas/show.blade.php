@extends('layouts.app')

@section('content')
            <h1>Your Idea : {{ $idea->title }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Idea Title:</strong> {{ $idea->title }}<br>
            <strong>Description:</strong> {{ $idea->description }}<br>
            <img src="/images/{{$idea->URLimage}}" alt="" height="100px" 
    width="150px" />
        </p>
    </div>
@endsection