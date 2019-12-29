<?php

namespace App\Http\Controllers;

use App\DeliveryCompany;
use App\CompanyName;
use App\District;
use Illuminate\Http\Request;

class DeliveryCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['delivery_companies'] = DeliveryCompany::all();

        return view('delivery_companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['company_names'] = CompanyName::all();
        $data['districts'] = District::all();

        return view('delivery_companies.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'company_name_id' => 'required',
            'district_id' => 'required',
            'zone' => 'required',
            'rate' => 'required',
            'cod_charge' => 'required',
            'type' => 'required',
        ]);

        DeliveryCompany::create($validatedData);

        return redirect()->route('delivery-companies.index')
                        ->with('success','Delivery Company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeliveryCompany  $deliveryCompany
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCompany $deliveryCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryCompany  $deliveryCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryCompany $deliveryCompany)
    {
        $data['company_names'] = CompanyName::all();
        $data['districts'] = District::all();
        $data['deliveryCompany'] = $deliveryCompany;

        return view('delivery_companies.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryCompany  $deliveryCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryCompany $deliveryCompany)
    {
        $validatedData = $this->validate($request, [
            'company_name_id' => 'required',
            'district_id' => 'required',
            'zone' => 'required',
            'rate' => 'required',
            'cod_charge' => 'required',
            'type' => 'required',
        ]);

        $delivery_companies = DeliveryCompany::find($deliveryCompany->id);
        $delivery_companies->company_name_id = $request->input('company_name_id');
        $delivery_companies->district_id = $request->input('district_id');
        $delivery_companies->zone = $request->input('zone');
        $delivery_companies->rate = $request->input('rate');
        $delivery_companies->cod_charge = $request->input('cod_charge');
        $delivery_companies->type = $request->input('type');
        $delivery_companies->save();


        return redirect()->route('delivery-companies.index')
                        ->with('success','Delivery Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryCompany  $deliveryCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryCompany $deliveryCompany)
    {
        $deliveryCompany->delete();
        return redirect()->route('delivery-companies.index')
                        ->with('success','Delivery Company deleted successfully');
    }

    public function getZone(Request $request)
    {
        return DeliveryCompany::where('company_name_id', $request->company_name_id)->where('district_id', $request->district_id)->get();
    }
}
