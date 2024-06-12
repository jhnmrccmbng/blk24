<?php

namespace App\Http\Controllers;

use Auth;
use App\Cartsorder;
use App\Statuses_action;
use Illuminate\Http\Request;

class StatusesActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statuses_action  $statuses_action
     * @return \Illuminate\Http\Response
     */
    public function show(Statuses_action $statuses_action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statuses_action  $statuses_action
     * @return \Illuminate\Http\Response
     */
    public function edit(Statuses_action $statuses_action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statuses_action  $statuses_action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statuses_action $statuses_action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statuses_action  $statuses_action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statuses_action $statuses_action)
    {
        //
    }

     public function update_status($orderID, $statusID){

        $order = Cartsorder::find($orderID);
        $order->update(['co_status_id' => $statusID]);
        $order->status_actions()->create(['sa_status_id' => $statusID, 'sa_user_id' => Auth::user()->id, 'sa_remarks' => '---']);

        return redirect()->back()->withSuccess('Order status successfully updated!');

    }
}
