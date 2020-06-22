<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Validator;
use JD\Cloudder\Facades\Cloudder;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::all();

        return response()->json($brands);

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
            'logo' => ['required', 'file', 'file'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'banner' => ['required', 'file', 'file'],
        ]);


        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }

        $logo = time().'.'.request()->logo->getClientOriginalExtension();
        $banner = 2 + time().'.'.request()->banner->getClientOriginalExtension();

        Cloudder::upload($request->file('logo'));
        $cloundary_upload = Cloudder::getResult();

        Cloudder::upload($request->file('banner'));
        $banner_upload = Cloudder::getResult();

        Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $cloundary_upload['url'],
            'banner' => $banner_upload['url']

        ]);

      //  request()->logo->move(public_path('../storage/app/public/images'), $logo);
      //  request()->banner->move(public_path('../storage/app/public/images'), $banner);

        return response()
            ->json(['success' => true ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand, $id)
    {
        //
      //  $br= Brand::with('products')->where('id', $id)->get();

        $br = $brand->findOrFail($id)->load('products');

        return response()->json($br);


    }

    public function adminShow(Brand $brand, $id)
    {
        return response()->json(Brand::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand, $id)
    {
         $brand = Brand::find($id);

                if(!$brand){
                    return response()
                        ->json(["error" => "Cet identifiant est inconnu"], 404);
                }

                $validation = Validator::make($request->all(), [
                  'logo' => ['required'],
                  'name' => ['required', 'string'],
                  'description' => ['required', 'string'],
                  'banner' => ['required'],
                ]);

                if ($validation->fails()) {

                    $message = $validation->messages()->toArray();
                    return response()
                        ->json(['error' => $message ], 422 );
                }
            $cloundary_upload = false;
            $banner_upload = false;


        if($request->logo !== $brand->logo){

//                    $logo = time().'.'.request()->logo->getClientOriginalExtension();
//                    request()->logo->move(public_path('../storage/app/public/images'), $logo);
//                    unlink('../storage/app/public/images/'.$brand->logo);

                    Cloudder::upload($request->file('logo'));
                    $cloundary_upload = Cloudder::getResult();
                }

                if($request->banner !== $brand->banner){
//                 $banner = 2 + time().'.'.request()->banner->getClientOriginalExtension();
//                 request()->banner->move(public_path('../storage/app/public/images'), $banner);
//                 unlink('../storage/app/public/images/'.$brand->banner);

                    Cloudder::upload($request->file('banner'));
                    $banner_upload = Cloudder::getResult();
                }

                $brand->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'logo' => $cloundary_upload ? $cloundary_upload['url'] : $brand->logo,
                        'banner' => $banner_upload ? $cloundary_upload['url'] : $brand->banner
                ]
                );

                return response()
                    ->json(['error' => Null, 'news' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, $id)
    {
        //
        $brand = Brand::find($id);

        if(!$brand){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

      //  unlink('../storage/app/public/images/'.$brand->logo);
      //  unlink('../storage/app/public/images/'.$brand->banner);

        $brand->delete();

        return response()
            ->json(["error" => Null ]);
    }
}
