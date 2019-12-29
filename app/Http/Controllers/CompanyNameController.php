<?php

namespace App\Http\Controllers;

use App\CompanyName;
use App\District;
use Illuminate\Http\Request;

class CompanyNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['company_names'] = CompanyName::all();

        return view('company_names.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::all();

        return view('company_names.create', $data);
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
            'name' => 'required'
        ]);

        CompanyName::create($request->all());

        return redirect()->route('company-names.index')
                        ->with('success','Delivery Company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyName  $company_names
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyName $company_name)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyName  $company_names
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyName $company_name)
    {
        $data['districts'] = District::all();
        $data['company_name'] = $company_name;

        return view('company_names.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyName  $company_names
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyName $company_name)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $company_name = CompanyName::find($company_name->id);
        $company_name->name = $request->input('name');
        $company_name->save();


        return redirect()->route('company-names.index')
                        ->with('success','Delivery Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyName  $company_names
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyName $company_name)
    {
        $company_name->delete();
        return redirect()->route('company-names.index')
                        ->with('success','Delivery Company deleted successfully');
    }

    public function getCompany()
    {
        return CompanyName::all();
    }

}
