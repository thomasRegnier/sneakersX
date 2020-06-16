<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\OrderProduct;
use App\MailShop;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
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

        $validation = Validator::make($request->user, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'adress' => ['required', 'string'],
            'city' => ['required', 'string'],
            'postalCode' => ['required' ,'numeric', 'digits:5'],
            'country' => ['required', 'string'],

        ]);

        if ($validation->fails()) {

            $message = $validation->messages()->toArray();
            return response()
                ->json(['error' => $message ], 422 );
        }


        $order = new Order();
        $bsk = $request->cart;
        $order->userInfo = $request->user['name'] .' '. $request->user['firstname'];
        $order->userEmail = $request->user['email'];
        $order->userAddress = $request->user['adress'] . ' ' . $request->user['city'] . ' ' . $request->user['postalCode'];
        $order->total = $bsk['total'];

        $order->save();

        $lastId = $order->id;

        foreach ($bsk['products'] as $bs){
            $orderProducts = new OrderProduct();

            $orderProducts->order_id = $lastId;
            $orderProducts->product_id = $bs['id'];
            $orderProducts->quantity = $bs['quantity'];
           // $orderProducts->color = $bs->color;
            $orderProducts->size = $bs['size'];

            $orderProducts->save();
        }

        $displayOrder = Order::find($lastId);
        $displayPrd = OrderProduct::where('order_id', $lastId)
            ->with('productsInOrder')
            ->get();



        Mail::to("thomas.regnier3001@gmail.com")->send(new MailShop($displayOrder, $displayPrd));
        Mail::to($request->user['email'])->send(new MailShop($displayOrder, $displayPrd));


        return response()
                ->json(
                    [
                        'order' => $displayOrder ,
                        'products' => $displayPrd
                    ]
                );


      //  dd($request->cart[0]['quantity']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, $id)
    {
        //


        $displayOrder = Order::find($id);
        $displayPrd = OrderProduct::where('order_id', $id)
            ->with('productsInOrder')
            ->get();




        return response()
            ->json(
                [
                    'order' => $displayOrder ,
                    'products' => $displayPrd
                ]
            );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
