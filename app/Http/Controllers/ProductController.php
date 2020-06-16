<?php

namespace App\Http\Controllers;

use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Image;
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
            ->where('active', 1)

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

    public function adminIndex()
    {
        $products = Product::with('brand', 'images')->get();
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

        $validation = Validator::make($request->all(), [
            'image' => ['required', 'file', 'file'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:1000'],
            'brand_id' => ['required', 'integer']

        ]);


        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }

        $image = time().'.'.request()->image->getClientOriginalExtension();

      $product =  Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'brand_id' => $request->brand_id,
            'image' => $image,
            'price' => $request->price,
            'active' => $request->active,
            'publish_at' => $request->publish_at
        ]);

//        Image::create([
//            'name' => $image,
//            'product_id' => $product->id
//        ]);

        request()->image->move(public_path('../storage/app/public/images'), $image);

        return response()
            ->json(['success' => true ]);
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
    public function update(Request $request, Product $product, $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

        $validation = Validator::make($request->all(), [
            'image' => ['required',],
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:1000'],
            'brand_id' => ['required', 'integer']
        ]);


        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }


        if($request->image !== $product->image){

            $image = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('../storage/app/public/images'), $image);
            unlink('../storage/app/public/images/'.$product->image);
        }


        $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'brand_id' => $request->brand_id,
                'image' => $image ?? $request->image,
                'price' => $request->price,
                'active' => $request->active,
                'publish_at' => $request->publish_at
            ]
        );

        return response()
            ->json(['error' => Null, 'news' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        //
        $product = Product::find($id);

        if(!$product){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

        unlink('../storage/app/public/images/'.$product->image);

        if(count($product->images) > 0){
            foreach ($product->images as $img){
                $i = Image::find($img['id']);
                unlink('../storage/app/public/images/'.$i->name);

                $i->delete();
            }
        }


        $product->delete();

        return response()
            ->json(["error" => Null ]);
    }
}
