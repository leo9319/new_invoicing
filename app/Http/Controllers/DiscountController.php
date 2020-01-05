<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:discount-list');
         $this->middleware('permission:discount-create', ['only' => ['create','store']]);
         $this->middleware('permission:discount-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:discount-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['discounts'] = Discount::all();

        return view('discounts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::all();

        return view('discounts.create', $data);
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
            'type' => 'required'
        ]);

        Discount::create($request->all());

        return redirect()->route('discounts.index')
                        ->with('success','Discount created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $data['products'] = Product::all();
        $data['discount'] = $discount;

        return view('discounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required'
        ]);

        $discount = Discount::find($discount->id);
        $discount->start_date = $request->input('start_date');
        $discount->end_date = $request->input('end_date');
        $discount->product_id = $request->input('product_id');
        $discount->name = $request->input('name');
        $discount->type = $request->input('type');
        $discount->amount = $request->input('amount');
        $discount->percentage = $request->input('percentage');
        $discount->save();

        return redirect()->route('discounts.index')
                        ->with('success','Discount updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')
                        ->with('success','Discount deleted successfully');
    }
}
