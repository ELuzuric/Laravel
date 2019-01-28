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



<!-- dropdown-menu (filter by)-->

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


<!-- Searh bar -->

<div class="container box">
   <h3 align="center">Shop</h3><br />
   
   <div class="form-group">
    <input type="text" name="title" id="title" class="form-control input-lg" placeholder="Enter tag words" />
    <div id="countryList">
    </div>
   </div>
   {{ csrf_field() }}
  </div>

<!-- list of the elements -->

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

        <body>

          <!-- TOP 3 Products ordered -->

@foreach($topproducts as $topproduct)


<div class="post-heading">
                    <div class="pull-left image">
                        <img src="/images/{{$topproduct->URLimage}}" alt="" height="100px" 
    width="150px" /></td>
                    </div>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b>{{$topproduct->title}}</b></a>
                           
                        </div>
                        <h6 class="text-muted time">{{$product->type}}</h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p>{{$topproduct->description}}</p>
                    <p>{{$topproduct->price}} $</p>
                    <div class="stats">
                        <a href="#" class="btn btn-default stat-item">
                             <a href="{{ URL::to('products/' . $topproduct->id . '/edit') }}">
                    <button type="button" class="btn btn-warning">Edit</button></i>
                        </a>
                        <a href="#" class="btn btn-default stat-item">
                             <form action="{{url('products', [$topproduct->id])}}" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" class="btn btn-danger" value="Delete"/>
            </form></i>
                        </a>
                    </div>
                </div>
                @endforeach <!-- END TOP 3 -->

</body>






<script>
$(document).ready(function(){

 $('#title').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#countryList').fadeIn();  
                    $('#countryList').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#title').val($(this).text());  
        $('#countryList').fadeOut();  
    });  

});
</script>

@endsection