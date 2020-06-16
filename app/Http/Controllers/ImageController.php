<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Validator;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'product_id' => ['required', 'integer']

        ]);


        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }

        $image = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('../storage/app/public/images'), $image);

       $newImage = Image::create([
            'name' => $image,
            'product_id' => $request->product_id,
        ]);

        return response()
            ->json(['success' => true, 'image' => $newImage ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image, $id)
    {
        //

        $image = Image::find($id);

        if(!$image){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

        unlink('../storage/app/public/images/'.$image->name);

        $image->delete();

        return response()
            ->json(["error" => Null ]);
    }
}
