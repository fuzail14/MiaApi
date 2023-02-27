<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Bill;
use Illuminate\Support\Facades\Validator;
use App\Models\User;



class BillController extends Controller
{
    
    public function generatebill(Request $request)
    {

      

     $isValidate = Validator::make($request->all(), [

        'subadminid' => 'required|exists:users,id',
        // "residentlist"=>'required',
        'duedate' => 'required',
        'billstartdate' => 'required',
        'billenddate' => 'required',
        'status'=>'required'
        ]);
        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false
            ], 403);
        }

       

        $li= [6,5];
        foreach ($li as $li)

{
    // print($li);

    $residnents = Resident::where('residentid', $li)->with('property')->with('measurement')->first();


    // print_r($residnents['measurement']);
    $measurement =$residnents['measurement'];
    $property =$residnents['property'];
    $charges=0.0;
    $chargesafterduedate=0.0;
    $appcharges=0.0;
    $tax=0.0;
    $balance=0.0;	
    $subadminid=$request->subadminid;
    $duedate=$request->duedate;
    $billstartdate=$request->billstartdate;
    $billenddate=$request->billenddate;
    
    $propertyid=0;
    $measurementid=0;
    $status=$request->status;

    $getmonth = Carbon::parse( $billstartdate)->format('F Y');
    $month=$getmonth;
  
    foreach ($measurement as $measurement)

    {

// print($measurement);
$measurementid=$measurement->id;
$charges=$measurement->charges;
$chargesafterduedate=$measurement->chargesafterduedate;
$appcharge=$measurement->appcharges;
$tax=$measurement->tax;
$balance=$charges;



    }

    foreach ($property as $property)

    { $propertyid= $property->id;

// print($property);

    }

    $bill = new Bill();

    $status =  $bill->insert(
        [

            [
                 'charges'=>$charges,
                 'chargesafterduedate'=>$chargesafterduedate,
                 'appcharges'=>$appcharge,
                 'tax'=>$tax,
                 'balance'=>$balance,
                'subadminid' => $request->subadminid,
                'propertyid'=>$propertyid,
                'measurementid'=>$measurementid,
                'duedate'=>$duedate,
                'billstartdate'=>$billstartdate,
                'billenddate'=>$billenddate,
                'month'=>$month,
                'status'=>$status,
               


                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

        ]
    );
  
    





}

        

      
       



       
   
    }

}
