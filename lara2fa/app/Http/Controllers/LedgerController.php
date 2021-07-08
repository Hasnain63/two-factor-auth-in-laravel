<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Triledger;


class LedgerController extends Controller
{
    function index()
    {
    	$month = date('n');
    	$year =  date('Y');
   
    	//$records = 	Triledger::all();  // Model getting all data from Database table triledger 
    	 $records = Triledger::whereMonth('created_at',$month) // Getting only current year and month value
   		 ->whereYear('created_at',$year)->orderBy('created_at', 'desc')
   		 ->get();
        return view('ledgerView',compact('records')); // 1- loading view 2- sending data to view 3- records is $records variable

    }

    function storeLedger()
    {


        $triledger = new Triledger();
 
        $triledger->amount = request('amount');
        $triledger->date = request('date');
        $triledger->time = request('time');
        $triledger->transaction_type = request('type');
        $triledger->payment_method = request('paymentmethod');
        $triledger->comment = request('comment');
 
        $triledger->save();
 
        return redirect('/ledger');

    }

    public function updateLedger(Request $request,  $id)
    {
	      $this->validate($request,array(
	       'title'       => 'required|max:255',
	       'body'         =>'required',
	     ));
	     $record = Triledger::find($id);
	     $record->amount = $request->amount;
	     $record->transaction_type=$request->type;
         $record->payment_method=$request->paymentmethod;
	     $record->comment=$request->comment;
	     $record->save();
	     return view('/ledger');
    }

    function destroyLedger($id)
	{

        $record = Triledger::find($id);
	    $record->delete();
	    return redirect('/ledger');

	}

}