<?php

namespace App\Http\Controllers;

use App\CompanyName;
use App\Discount;
use App\District;
use App\Inventory;
use App\Product;
use App\Sale;
use App\SaleProduct;
use App\Voucher;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data['vouchers'] = Voucher::where('start_date', '<=', Carbon\Carbon::now())
        ->where('end_date', '>=', Carbon\Carbon::now())->get();
        $data['inventories'] = Inventory::all();
        $data['company_names'] = CompanyName::all();
        $data['company_districts'] = District::all();

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
            ],
            [
                'delivery_company_id.required' => 'Please select the delivery zone correctly',
            ]
        );

        // get the discount count of the current latest campaign
        $discount =  Discount::where('start_date', '<=', Carbon\Carbon::now())
        ->where('end_date', '>=', Carbon\Carbon::now())->first();

        $sale = new Sale;

        $sale->voucher_id = $request->voucher_id;
        $sale->delivery_company_id = $request->delivery_company_id;
        $sale->discount_id = $discount->id ?? NULL;
        $sale->date = $request->date;
        $sale->client_name = $request->client_name;
        $sale->client_address = $request->client_address;
        $sale->client_phone = $request->client_phone;
        $sale->client_email = $request->client_email;
        $sale->client_address = $request->client_address;
        $sale->advance_payment = $request->advance_payment ? 1 : 0;
        $sale->save();

        foreach ($request->product_id as $index => $product_id) {

            $price = $request->mrp[$index];

            $product = Product::find($product_id);

            if(isset($request->voucher_id) && ($product->voucher->id == $request->voucher_id)) {
                $price = $request->mrp[$index] - ($request->mrp[$index] * ($product->voucher->discount_percentage))/100;
            }

            $sale->products()->attach([
                $product_id => ['quantity' => $request->quantity[$index], 'price' => $price, 'remarks' => $request->remarks[$index]],
            ]);

            $product->removeFromInventory($request->quantity[$index]);
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

    public function viewInvoice(Sale $sale)
    {
        return view('sales.view_invoice', compact('sale'));
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
        $sale->products()->detach();
        $sale->delete();
        return redirect()->route('sales.index')
                        ->with('success','Sale deleted successfully');
    }

    public function returnedProducts(Sale $sale)
    {
        return view('sales.returned_products', compact('sale'));
    }

    public function storeReturnedProducts(Request $request)
    {
        foreach ($request->ids as $index => $id) {
            $product_sale = DB::table('product_sale')->where('id', $id);
            $product_sale->update([
                'returned' => $request->returned[$index],
                'damaged' => $request->damaged[$index],
            ]);

            if($request->returned[$index]) {
                $product = Product::find($product_sale->first()->product_id);
                $product->addToInventory($request->returned[$index]);
            }

        }

        return back();
    }

    public function updateHandlingStatus(Request $request)
    {
        return Sale::whereIn('id', $request->sale_ids)->update([
            'handed_over' => 'yes'
        ]);
    }

    public function updateDeliveryStatus(Request $request)
    {
        return Sale::whereIn('id', $request->sale_ids)->update([
            'delivered' => $request->status
        ]);
    }

    public function generateInvoices()
    {
        return view('sales.generate_invoices');
    }

    public function storeGenerateInvoices(Request $request)
    {
        $sales = Sale::whereBetween('date', [$request->start_date, $request->end_date])->get();

        return view('sales.show_generate_invoices', compact('sales'));
    }
}
