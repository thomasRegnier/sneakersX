<?php

namespace App\Http\Controllers;

use App\news;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use JD\Cloudder\Facades\Cloudder;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
       // dd($request->max);
        $max = $request->max ? $request->max : null;
        $news = news::orderBy('publish_at', 'desc')
                                ->where('active', 1)
                                ->where('publish_at', '<=',  Carbon::now())
                                ->take($max)
                                ->get();
        return response()->json($news);

    }


    public function indexAdmin()
    {
        return response()->json(news::all());
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
            'contentNews' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],

        ]);


        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }

      //  $image = time().'.'.request()->image->getClientOriginalExtension();
      //  Cloudder::upload($image, null, [], []);

        Cloudder::upload($request->file('image'));
        $cloundary_upload = Cloudder::getResult();


        news::create([
            'title' => $request->title,
            'content' => $request->contentNews,
            'description' => $request->description,
            'author' => $request->author,
            'image' => $cloundary_upload['url'],
            'publish_at' => $request->publish_at
        ]);
      //  request()->image->move(public_path('../storage/app/public/images'), $image);

        return response()
            ->json(['success' => true ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show(news $news, $id)
    {
        //
        return response()->json(news::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $news = news::find($id);

        if(!$news){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

        $validation = Validator::make($request->all(), [
            'image' => ['required'],
            'contentNews' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
        ]);


        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }


        if($request->image !== $news->image){

            Cloudder::upload($request->file('image'));
            $cloundary_upload = Cloudder::getResult();

//            $image = time().'.'.request()->image->getClientOriginalExtension();
//            request()->image->move(public_path('../storage/app/public/images'), $image);
//            unlink('../storage/app/public/images/'.$news->image);

        }


       // $request->image = $image;

        $cloundary_upload = false;

        $news->update([
                'title' => $request->title,
                'content' => $request->contentNews,
                'description' => $request->description,
                'author' => $request->author,
                'image' => $cloundary_upload ? $cloundary_upload['url'] : $news->image,
                'publish_at' => $request->publish_at,
                'active' => $request->isActive
        ]
        );

        return response()
            ->json(['error' => Null, 'news' => $news]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(news $news, $id)
    {
        //

        $news = news::find($id);

        if(!$news){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

      //  unlink('../storage/app/public/images/'.$news->image);

        $news->delete();


        return response()
            ->json(["error" => Null ]);
    }
}
