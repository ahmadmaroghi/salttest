<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\Balance;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('balance.index');
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
            'mobile'                => 'required|min:7|max:12',
            'value'                 => 'required'
        ];
  
        $messages = [
            'mobile.required'       => 'Mobile wajib diisi',
            'mobile.min'            => 'Mobile minimal 7 karakter',
            'mobile.max'            => 'Mobile maksimal 12 karakter',
            'value.required'        => 'Value wajib diisi'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $balance = new Balance;
        $balance->mobile = $request->mobile;
        $balance->value = $request->value;
        $balance->id_user = Auth::user()->id;
        $simpan = $balance->save();
  
        if($simpan){
            Session::flash('success', 'Prepaid Balance Berhasil!');
            return redirect()->route('balance');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('balance');
        }
    }
}
