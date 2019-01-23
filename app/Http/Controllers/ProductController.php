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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products',$products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            //Validate
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'price' => 'required',
        ]);

        $user = new file;

        if(Input::hasFile('file')){

            $file = Input::file('file');
            $file->move(public_path(). '/images', $file->getClientOriginalName());
               $user->title = $file->getClientOriginalName();
                $id = DB::getPdo()->lastInsertId();
          
        }
        $product = Product::create(['type' => $request->type,'title' => $request->title,'description' => $request->description, 'price' => $request->price, 'URLimage' =>$user->title]);
        return redirect('/products/'.$product->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product',$product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product',$product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //Validate
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product->type = $request->type;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        $request->session()->flash('message', 'Successfully modified the product!');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        $request->session()->flash('message', 'Successfully deleted the product!');
        return redirect('products');
    }

      public function filterUp(){

        
        $products = DB::table('products')->orderBy('price', 'asc') ->get();

        return view('products.index',compact('products'));
    
  }

  public function filterDown(){

        
        $products = DB::table('products')->orderBy('price', 'desc') ->get();

        return view('products.index',compact('products'));
    
  }

  public function filterAZ(){

        
        $products = DB::table('products')->orderBy('type', 'asc') ->get();

        return view('products.index',compact('products'));
    
  }

  public function filterZA(){

        
        $products = DB::table('products')->orderBy('type', 'desc') ->get();

        return view('products.index',compact('products'));
    
  }
}