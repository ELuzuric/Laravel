@extends('layouts.app')

@section('content')
            <h1>Showing Product {{ $product->title }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Product Title:</strong> {{ $product->title }}<br>
            <strong>Description:</strong> {{ $product->description }}<br>
            <strong>Product Price:</strong> {{ $product->price }}<br>
            <img src="/images/{{$product->URLimage}}" alt="" height="100px" 
    width="150px" />
        </p>
    </div>
@endsection