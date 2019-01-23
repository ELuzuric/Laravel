@extends('layouts.app')

@section('content')
    <h1>Add Participation</h1>
    <hr>
     <form action="/participates" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" value="{{Auth::user()->firstName}}" class="form-control" id="participateFirstName"  name="firstName">
      </div>
      <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" value="{{Auth::user()->lastName}}" class="form-control" id="participateLastName" name="lastName">
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