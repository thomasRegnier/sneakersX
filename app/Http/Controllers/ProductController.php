<?php

namespace App\Http\Controllers;

use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

     //   $search = $request->search;

        $products = Product::with('brand', 'images')
            ->where('active', 0)

            ->when(request('sort'), function($query){
                $query->inRandomOrder();
            })
            ->when(request('max'), function($query){
                $query->take(request('max'));
            })

            ->when(request('search'), function ($query){
                $search = request('search');
                $query->where('products.name', 'LIKE', '%'. $search .'%');
            })

            ->when(request('brand'), function ($query){
                $query->where('products.brand_id', request('brand'));

            })

           // ->get();

           ->paginate($request->max ? $request->max : 3);


        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        //
        $product = $product->findOrFail($id)->load('brand', 'images');


        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
