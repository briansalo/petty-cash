<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpensesController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['date'] = PettyCash::where('id', $id)->first();

        $data['cash_in'] = PettyCashAmount::where('petty_cash_id', $id)->get();
        $total=[];
          foreach($data['cash_in'] as $row){
                $total[] =$row->cash_in;


          }
          $data['total_cash_in'] = array_sum($total);
          //dd($data['total_cash_in']);

          //to use condition is home.blade
        $data['alldata'] = PettyCashInfo::where('petty_cash_id', $id)->orderBy('created_at','desc')->get();
        //$get=[];
        //foreach ($data['alldata']   as $key => $value) {
          //      $get[] =$value->name;            # code...
        //}
            //dd($get);
        $total1=[];
        foreach($data['alldata'] as $row){
            $total1[] = $row->amount;
        }
            $data['expenses_total_amount'] = array_sum($total1);
        return view('expenses_view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
