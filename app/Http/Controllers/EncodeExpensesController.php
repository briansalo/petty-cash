<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PettyCash; 
use App\Models\PettyCashInfo; 
use App\Models\PettyCashAmount;
use App\Models\Picture; 
use App\Models\CashOut; 
use Carbon\Carbon;

use PDF;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GeneratePettyCash;

class EncodeExpensesController extends Controller
{
    public function Home(){
    	$data['alldata'] = PettyCash::orderBy('created_at', 'desc')->get();

        $data['cash_out'] = CashOut::all();
      
    	return view('home', $data);
    }

    public function ExpensesView($id){
    	
    	$data['date'] = PettyCash::where('id', $id)->first();

        $data['cash_in'] = PettyCashAmount::where('petty_cash_id', $id)->get();
        $total=[];
          foreach($data['cash_in'] as $row){
                $total[] =$row->cash_in;
          }

          $data['total_cash_in'] = array_sum($total);
        
          //to use condition is home.blade
    	$data['alldata'] = PettyCashInfo::where('petty_cash_id', $id)->orderBy('created_at','desc')->get();
       
        $total1=[];
        foreach($data['alldata'] as $row){
            $total1[] = $row->amount;
        }
            $data['expenses_total_amount'] = array_sum($total1);

    	return view('expenses_view', $data);
    }


    public function ExpensesEdit($id){
      
        $data['date'] = PettyCash::where('id', $id)->first();

        $data['cash_in'] = PettyCashAmount::where('petty_cash_id', $id)->get();
        $total=[];
          foreach($data['cash_in'] as $row){
                $total[] =$row->cash_in;
          }

        $data['total_cash_in'] = array_sum($total);
          
        $data['alldata'] = PettyCashInfo::where('petty_cash_id', $id)->orderBy('created_at','desc')->get();
    
        $total1=[];
        foreach($data['alldata'] as $row){
            $total1[] = $row->amount;
        }

        $data['expenses_total_amount'] = array_sum($total1);

        return view('expenses_edit', $data);
    }


    public function ExpensesAdd(Request $request){
    	//if the petty cash already generated you can't change anything to avoid human error
         $check = PettyCash::where('id', $request->id)->first();
        if($check->status ==1){       
        	$create = new PettyCashInfo;
        	$create->petty_cash_id = $request->id;
        	$create->receipt_date = $request->date;
        	$create->name = $request->care_of;
        	$create->description = $request->description;
        	$create->amount = $request->amount;
        	$create->save();
    	}
    	return redirect()->route('expenses.edit',$request->id);
    }

    public function ExpensesDelete($id){


            $data= PettyCashInfo::find($id);
            //if the petty cash already generated you can't change anything to avoid human error
            $check = PettyCash::where('id', $data->petty_cash_id)->first();
            if($check->status ==1){
                $data->delete();
            }

        return redirect()->route('expenses.edit',$data->petty_cash_id);
    }
    public function PettyCashAdd(){
    	$carbon = new Carbon();

    	$create = new PettyCash;
    	$create->petty_cash_date = $carbon;
    	$create->save();

    	return redirect('home');
    }

    public function CashIn(Request $request){
        //if the petty cash already generated you can't change anything to avoid human error
         $check = PettyCash::where('id', $request->id)->first();
        if($check->status ==1){       
            $create = new PettyCashAmount;
            $create->petty_cash_id = $request->id;
            $create->cash_in = $request->amount;
            $create->given_by = $request->given_by;
            $create->save();
        }

        return redirect()->route('expenses.edit',$request->id);

    }

    public function CashIndDelete($id){
        
       $data= PettyCashAmount::find($id);

       //if the petty cash already generated you can't change anything
       $check = PettyCash::where('id', $data->petty_cash_id)->first();
       if($check->status ==1){
           $data->delete();
       }
        return redirect()->route('expenses.edit',$data->petty_cash_id);
    }

    public function CashOut(Request $request){
        $carbon = new Carbon();

        $create =  new CashOut;
        $create->petty_cash_id = $request->id;
        $create->date = $carbon;
        $create->name = $request->care_of;
        $create->description = $request->description;
        $create->amount = $request->amount;
        $create->save();

        return redirect()->route('home');
    }


    public function CashOutClose($id){
                
        Cashout::find($id)->delete();

        return redirect()->route('home');
    }

    public function ExportExcel($id){
    
        return Excel::download(new GeneratePettyCash($id), 'PettyCash.xlsx');

    }

    public function GeneratePettyCash($id){

        //from expensesview for pdf
        $data['date'] = PettyCash::where('id', $id)->first();

        $data['cash_in'] = PettyCashAmount::where('petty_cash_id', $id)->get();
        $total=[];
          foreach($data['cash_in'] as $row){
                $total[] =$row->cash_in;


          }
          $data['total_cash_in'] = array_sum($total);
          //dd($data['total_cash_in']);

        $data['alldata'] = PettyCashInfo::where('petty_cash_id', $id)->get();
        $total1=[];
        foreach($data['alldata'] as $row){
            $total1[] = $row->amount;
        }
            $data['expenses_total_amount'] = array_sum($total1);

        PettyCash::where('id', $id)->update(['status'=> 0]);

        $pdf = PDF::loadView('pdf_view', $data);

       return $pdf->download('pdf_file.pdf');


    }



}
