<?php

namespace App\Http\Controllers;

use App\User;
use App\Brand;
use Illuminate\Http\Request;

class BrandUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::role('Brand Manager')->get();

        return view('brand_users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['brand_users'] = User::role('Brand Manager')->get();
        $data['brands'] = Brand::all();

        return view('brand_users.create', $data);
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
            'user_id' => 'required',
            'brand_ids' => 'required',
        ]);

        $user = User::find($request->user_id);

        $user->brands()->sync($request->brand_ids);

        return redirect()->route('brand-users.index')
                        ->with('success','Brand Manager created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BrandUser  $brandUser
     * @return \Illuminate\Http\Response
     */
    public function show(BrandUser $brandUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BrandUser  $brandUser
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandUser $brandUser)
    {
        return view('brand_users.edit', compact('BrandUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BrandUser  $brandUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandUser $brandUser)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'brand_ids' => 'required',
        ]);

        $BrandUser = BrandUser::find($id);
        $BrandUser->name = $request->input('name');
        $BrandUser->save();


        return redirect()->route('brand_users.index')
                        ->with('success','Brand(s) removed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BrandUser  $brandUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        $user->brands()->detach();
        return redirect()->route('brand-users.index')
                        ->with('success','Brand Manager deleted successfully');
    }
}
