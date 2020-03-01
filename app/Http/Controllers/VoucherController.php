<?php

namespace App\Http\Controllers;

use App\Voucher;
use App\Product;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:voucher-list');
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['vouchers'] = Voucher::all();

        return view('vouchers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::all();

        return view('vouchers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'influencer_code' => 'required',
            'discount_percentage' => 'required',
            'product_id' => 'required',
        ]);

        Voucher::create($request->all());

        return redirect()->route('vouchers.index')
                        ->with('success','Voucher created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        $data['products'] = Product::all();
        $data['voucher'] = $voucher;

        return view('vouchers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'influencer_code' => 'required',
            'discount_percentage' => 'required',
            'product_id' => 'required',
        ]);

        $voucher = Voucher::find($voucher->id);
        $voucher->start_date = $request->input('start_date');
        $voucher->end_date = $request->input('end_date');
        $voucher->product_id = $request->input('product_id');
        $voucher->influencer_code = $request->input('influencer_code');
        $voucher->discount_percentage = $request->input('discount_percentage');
        $voucher->save();

        return redirect()->route('vouchers.index')
                        ->with('success','Voucher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('vouchers.index')
                        ->with('success','Voucher deleted successfully');
    }
}
