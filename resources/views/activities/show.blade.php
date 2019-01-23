@extends('layouts.app')

@section('content')
            <h1>Showing your Activity : {{ $activity->title }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Activity Title:</strong> {{ $activity->title }}<br>
            <strong>Description:</strong> {{ $activity->description }}<br>
            <strong>Date:</strong> {{ $activity->date }}<br>
            <strong>Condition:</strong> {{ $activity->condition }}<br>
            <strong>Recurrence:</strong> {{ $activity->recurrence }}<br>
            <strong>Time:</strong> {{ $activity->time }}<br>
        </p>
        @can('isStudentsUnion')
        <a href="{{url('participates')}}"> <button type="submit" class="btn btn-primary">List of registered</button> </a>
        @endcan
    </div>
@endsection