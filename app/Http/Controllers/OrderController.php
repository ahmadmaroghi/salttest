<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;

class OrderController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_no, $id_product, $id_user)
    {
        $order = Order::join('product', 'order.id_product', '=', 'product.id')
                    ->where('order_no', $order_no)
                    ->where('id_product', $id_product)
                    ->where('id_user', Auth::user()->id)
                    ->first();
        return view('order.index', compact('order'));
    }

}
