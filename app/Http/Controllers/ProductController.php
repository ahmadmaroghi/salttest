<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Balance;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product'               => 'required|min:10|max:150',
            'address'               => 'required|min:10|max:150',
            'price'                 => 'required'
        ];
  
        $messages = [
            'product.required'       => 'Product wajib diisi',
            'product.min'            => 'Product minimal 10 karakter',
            'product.max'            => 'Product maksimal 150 karakter',
            'address.required'       => 'Address wajib diisi',
            'address.min'            => 'Address minimal 10 karakter',
            'address.max'            => 'Address maksimal 150 karakter',
            'price.required'         => 'Price wajib diisi'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        // select value balance
        $idBalance = Balance::where('id_user', Auth::user()->id)->first();
        $totalTopup = $idBalance->value + ((5/100) * $idBalance->value);
        $totalProduct = $idBalance->value + 10000;
  
        $product = new Product;
        $product->product = $request->product;
        $product->address = $request->address;
        $product->price = $request->price;
        $simpanProduct = $product->save();
  
        if($simpanProduct){
            $order = new Order;
            $order->order_no = $this->generateUniqueCode();
            $order->total_balance = $totalTopup;
            $order->total_product = $totalProduct;
            $order->id_user = Auth::user()->id;
            $order->id_product = $product->id;
            $simpanOrder = $order->save();

            if ($simpanOrder) {
                Session::flash('success', 'Product is successfully');
                return redirect()->route('order', [
                    'order_no' => $order->order_no,
                    'id_product' => $product->id,
                    'id_user' => Auth::user()->id
                ]);
            }else{
                Session::flash('errors', ['' => 'Order is not successfully']);
                return redirect()->route('product');
            }
        } else {
            Session::flash('errors', ['' => 'Product is not successfully']);
            return redirect()->route('product');
        }
    }

    /**
     * Write referal_code on Method
     *
     * @return response()
     */
    public function generateUniqueCode()
    {
        do {
            $referal_code = random_int(1000000000, 9999999999);
        } while (Order::where("order_no", "=", $referal_code)->first());
  
        return $referal_code;
    }
}
