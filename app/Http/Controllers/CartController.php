<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Input;
use DB;

class ProductController extends Controller
{
public function cart()
    {
        return view('cart');
    }
    //public function deleteFromCart()
     //    {
     //   $product->delete();
     //   $request->session()->flash('message', 'Successfully deleted the product!');
     //   return redirect('products');
    }
}