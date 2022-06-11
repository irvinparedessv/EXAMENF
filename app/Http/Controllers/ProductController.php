<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendedor;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $vendedor=Vendedor::where('id_usuario', $userId)->first();
        if($vendedor){
        $products = Product::where('id_vendedor',$vendedor->id)->get();
        $isaudi=false;
        }else{
        $products = Product::all();
        $isaudi=true;
        }

        return response()->json(['message' => 'success', 'products'=>$products,'isaudi'=>$isaudi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $vendedor=Vendedor::where('id_usuario', $userId)->first();
        $request['id_vendedor']=$vendedor->id;
        Product::insert($request->all());
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Product::where('id', $product->id)->update($request->all());
        return response()->json(["message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::where('id', $product->id)->delete();
        return response()->json(["message"=>"success"]);
    }
}
