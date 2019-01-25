@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <hr>
     <form action="{{url('products', [$product->id])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Product Type</label>
        <input type="text" value="{{$product->type}}" class="form-control" id="productTitle"  name="type" >
      </div>
      <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" value="{{$product->title}}" class="form-control" id="productTitle"  name="title" >
      </div>
      <div class="form-group">
        <label for="description">Product Description</label>
        <input type="text" value="{{$product->description}}" class="form-control" id="productDescription" name="description" >
      </div>
      <div class="form-group">
        <label for="price">Product Price</label>
        <input type="text" value="{{$product->price}}" class="form-control" id="productPrice" name="price" >
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