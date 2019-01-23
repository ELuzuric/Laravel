@extends('layouts.app')

@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Created At</th>
              <th scope="col">Option</th>
            </tr>
          </thead>
          <tbody>
            @foreach($participates as $participate)
            <tr>
              <th scope="row">{{$participate->id}}</th>
              <td>{{$participate->firstName}}</td>
              <td>{{$participate->lastName}}</td>
              <td>{{$participate->created_at->toFormattedDateString()}}</td>
              <td>
                <form action="{{url('participates', [$participate->id])}}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection