<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use APP\Models\Resident;

use APP\Models\Societyapartmentresidentaddress;


use APP\Models\User;


class VerifySocietyApartmentResidentController extends Controller
{
    public function verifysocietyapartmentresident(Request $request)

    {
        $isValidate = Validator::make($request->all(), [


            'residentid' => 'required|exists:residents,residentid',
            'status' => 'required',
            'pid' => 'required',
            'buildingid' => 'required',
            'floorid' => 'required',

            'apartmentid' => 'required',
            'vechileno' => 'nullable',
            'measurementid' => 'required'

        ]);


        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false

            ], 403);
        }





        $residents = Societyapartmentresidentaddress::where('residentid', $request->residentid)->first();

        // dd( $residents->status);

        $residents->pid = $request->pid;
        $residents->buildingid = $request->buildingid;
        $residents->floorid = $request->floorid;
        $residents->apartmentid = $request->apartmentid;
        $residents->measurementid = $request->measurementid;
        $residents->update();

        $res = Resident::where('residentid', $residents->residentid)->first();
        $res->status = $request->status;
        $res->vechileno = $request->vechileno ?? '';
        $res->update();


        $user = User::where('id',  $residents->residentid)->first();
        $user->address =  $res->houseaddress;
        $user->update();



        return response()->json([
            "success" => true,
            "data" => $residents

        ]);
    }
}
