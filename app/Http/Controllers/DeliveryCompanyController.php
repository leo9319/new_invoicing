<?php

namespace App\Http\Controllers;

use App\DeliveryCompany;
use App\DistrictAndZone;
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
        $data['district_and_zones'] = DistrictAndZone::all();

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
        $this->validate($request, [
            'district_and_zone_id' => 'required',
            'name' => 'required',
            'cod_charge' => 'required',
            'type' => 'required',
        ]);

        DeliveryCompany::create($request->all());

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
        $data['district_and_zones'] = DistrictAndZone::all();
        $data['delivery_company'] = $deliveryCompany;

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
        $this->validate($request, [
            'district_and_zone_id' => 'required',
            'name' => 'required',
            'cod_charge' => 'required',
            'type' => 'required',
        ]);

        $delivery_company = DeliveryCompany::find($deliveryCompany->id);
        $delivery_company->district_and_zone_id = $request->input('district_and_zone_id');
        $delivery_company->name = $request->input('name');
        $delivery_company->cod_charge = $request->input('cod_charge');
        $delivery_company->type = $request->input('type');
        $delivery_company->save();


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
}
