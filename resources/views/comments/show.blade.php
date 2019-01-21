@extends('layouts.app')

@section('content')
            <h1>Showing Comment {{ $comment->title }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Comment Title:</strong> {{ $comment->title }}<br>
            <strong>Description:</strong> {{ $comment->description }}
        </p>
    </div>
@endsection