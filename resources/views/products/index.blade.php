@extends('layouts.app')

@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">product Type</th>
              <th scope="col">product Title</th>
              <th scope="col">product Description</th>
              <th scope="col">product Price</th>
              <th scope="col">product Photo</th>
              
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            <div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Filter by <span class="caret"></span>
  </button>

  <ul class="dropdown-menu">
     <li><a href="/products" title="Lien 2">Default</a></li>
     <li><a href="/products/index/filter_priceasc" title="Lien 1">Price (low to high)</a></li>
     <li><a href="/products/index/filter_pricedesc" title="Lien 2">Price (high to low)</a></li>
     <li><a href="/products/index/filter_typeasc" title="Lien 3">Category (A to Z)</a></li>
     <li><a href="/products/index/filter_typedesc" title="Lien 4">Category (Z to A)</a></li>

  </ul>
</div>

            @foreach($products as $product)
            <tr>
              <th scope="row">{{$product->id}}</th>
              <td>{{$product->type}}</td>
              <td><a href="/products/{{$product->id}}">{{$product->title}}</a></td>
              <td>{{$product->description}}</td>
              <td>{{$product->price}} $</td>
              <td><img src="/images/{{$product->URLimage}}" alt="" height="100px" 
    width="150px" /></td>
              
              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('products/' . $product->id . '/edit') }}">
                  	<button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('products', [$product->id])}}" method="POST">
    					<input type="hidden" name="_method" value="DELETE">
   						<input type="hidden" name="_token" value="{{ csrf_token() }}">
   						<input type="submit" class="btn btn-danger" value="Delete"/>
   				  </form>
              </div>
			</td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection