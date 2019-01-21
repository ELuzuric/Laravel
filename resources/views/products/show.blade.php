@extends('layouts.app')

@section('content')
            <h1>Showing Product {{ $product->title }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Product Title:</strong> {{ $product->title }}<br>
            <strong>Description:</strong> {{ $product->description }}<br>
            <strong>Product Price:</strong> {{ $product->price }}<br>
        </p>
    </div>
@endsection