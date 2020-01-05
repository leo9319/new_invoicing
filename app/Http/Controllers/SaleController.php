<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Voucher;
use App\Discount;
use App\Product;
use App\CompanyName;
use App\SaleProduct;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:sale-list');
         $this->middleware('permission:sale-create', ['only' => ['create','store']]);
         $this->middleware('permission:sale-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['sales'] = Sale::all();

        return view('sales.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['vouchers'] = Voucher::all();
        $data['discounts'] = Discount::all();
        $data['products'] = Product::all();
        $data['company_names'] = CompanyName::all();

        return view('sales.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'date' => 'required',
            'client_name' => 'required',
            'delivery_company_id' => 'required',
            'client_phone' => 'required',
            'client_address' => 'required',
            'product_id' => 'required',
        ]);

        $sale = new Sale;

        $sale->voucher_id = $request->voucher_id;
        $sale->delivery_company_id = $request->delivery_company_id;
        $sale->discount_id = $request->discount_id;
        $sale->date = $request->date;
        $sale->client_name = $request->client_name;
        $sale->client_address = $request->client_address;
        $sale->client_phone = $request->client_phone;
        $sale->client_email = $request->client_email;
        $sale->client_address = $request->client_address;
        $sale->save();

        foreach ($request->product_id as $index => $product_id) {
            $sale->products()->attach([
                $product_id => ['quantity' => $request->quantity[$index], 'price' => $request->mrp[$index], 'remarks' => $request->remarks],
            ]);
        }

        return redirect()->route('sales.index')
                        ->with('success','Sale created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $data['vouchers'] = Voucher::all();
        $data['discounts'] = Discount::all();
        $data['products'] = Product::all();
        $data['company_names'] = CompanyName::all();
        $data['sale'] = $sale;

        return view('sales.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->validate($request, [
            'date' => 'required',
            'client_name' => 'required',
            'client_phone' => 'required',
            'client_address' => 'required',
            'client_email' => 'required',
            'product_id' => 'required',
        ]);

        $sale = Sale::find($id);
        $sale->name = $request->input('name');
        $sale->save();


        return redirect()->route('sales.index')
                        ->with('success','Sale updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')
                        ->with('success','Sale deleted successfully');
    }
}
