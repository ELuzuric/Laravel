@extends('layouts.app')

@section('content')
            <h1>Your Idea : {{ $idea->title }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Idea Title:</strong> {{ $idea->title }}<br>
            <strong>Description:</strong> {{ $idea->description }}
        </p>
    </div>
@endsection