@extends('layouts.app')

@section('content')
    <h1>Add New Product</h1>
    <hr>
     <form action="/products" method="post" enctype="multipart/form-data">
     {{ csrf_field() }}
     <div class="form-group">
        <label for="type">Product Type</label>
        <input type="text" class="form-control" id="productType"  name="type">
      </div>
      <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" class="form-control" id="taskTitle"  name="title">
      </div>
      <div class="form-group">
        <label for="description">Product Description</label>
        <input type="text" class="form-control" id="productDescription" name="description">
      </div>
      <div class="form-group">
        <label for="price">Product Price</label>
        <input type="text" class="form-control" id="productPrice" name="price">
      </div>

       
             <label  for="file">Picture</label>
            <input type="file" name="file" id="file">

            <input type="hidden" value="{{ csrf_token() }}" name="_token">
       <button type="submit" class="btn btn-primary"> Add Pitcure</button>

      
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
    
    </form>
@endsection