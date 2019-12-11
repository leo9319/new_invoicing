<?php

namespace App\Http\Controllers;

use App\DistrictAndZone;
use Illuminate\Http\Request;

class DistrictAndZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['district_and_zones'] = DistrictAndZone::all();

        return view('district_and_zones.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('district_and_zones.create');
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
            'district' => 'required',
            'zone' => 'required',
        ]);

        DistrictAndZone::create($request->all());

        return redirect()->route('district-and-zones.index')
                        ->with('success','District and Zone created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DistrictAndZone  $districtAndZone
     * @return \Illuminate\Http\Response
     */
    public function show(DistrictAndZone $districtAndZone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DistrictAndZone  $districtAndZone
     * @return \Illuminate\Http\Response
     */
    public function edit(DistrictAndZone $districtAndZone)
    {
        return view('district_and_zones.edit', compact('districtAndZone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DistrictAndZone  $districtAndZone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DistrictAndZone $districtAndZone)
    {
        $this->validate($request, [
            'district' => 'required',
            'zone' => 'required',
        ]);

        $district_and_zone = DistrictAndZone::find($districtAndZone->id);
        $district_and_zone->district = $request->input('district');
        $district_and_zone->zone = $request->input('zone');
        $district_and_zone->save();

        return redirect()->route('district-and-zones.index')
                        ->with('success','District And Zone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DistrictAndZone  $districtAndZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistrictAndZone $districtAndZone)
    {
        $districtAndZone->delete();
        return redirect()->route('district-and-zones.index')
                        ->with('success','Zone and District deleted successfully');
    }
}
