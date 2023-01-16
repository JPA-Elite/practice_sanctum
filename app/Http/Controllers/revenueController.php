<?php

namespace App\Http\Controllers;

use App\Models\revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class revenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return revenue::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
            'username' => 'required|string|min:5|max:10',
            'password' => 'required|confirmed',
            'amount' => 'required|integer|min:0'
            ]
        );


        $data = revenue::create([
            'username' =>  $validated['username'],
            'password' =>  Hash::make($validated['password']),
            'amount' =>  $validated['amount']
        ]);

        $token = $data->createToken('registration', ['create'])->plainTextToken;
        return response([
            'token' => $token
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return revenue::findorFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function edit(revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $val = revenue::find($id);
        $val->update([
            'username' => $request -> username,
            'password' => $request -> password,
            'amount' => $request -> amount
        ]);
        return $val;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return revenue::destroy($id);
    }
}
