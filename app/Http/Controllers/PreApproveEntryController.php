<?php
namespace App\Http\Controllers;
use App\Models\Gatekeeper;
use App\Models\Preapproveentry;
use Illuminate\Http\Request;
use App\Models\Visitortype;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class PreApproveEntryController extends Controller
{
    public function addpreapproventry(Request $request)
    {
        $isValidate = Validator::make($request->all(), [
            'gatekeeperid' => 'required|exists:users,id',
            'userid' => 'required|exists:users,id',
            'visitortype' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'cnic' => 'nullable',
            'mobileno' => 'required',
            'vechileno' => 'nullable',
            'arrivaldate' => 'required|date',
            'arrivaltime' => 'required',
            'status' => 'required',
            'statusdescription' => 'required',
        ]);
        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false
            ], 403);
        }
        $preapprovedentry= new Preapproveentry();
        $preapprovedentry->gatekeeperid=$request->gatekeeperid;
        $preapprovedentry->userid=$request->userid;
        $preapprovedentry->visitortype=$request->visitortype;
        $preapprovedentry->name=$request->name;
        $preapprovedentry->description=$request->description??"";
        $preapprovedentry->cnic=$request->cnic??"";
        $preapprovedentry->mobileno=$request->mobileno;
        $preapprovedentry->vechileno=$request->vechileno;
        $preapprovedentry->arrivaldate=  Carbon::parse($request->arrivaldate)->format('y-m-d');
        $preapprovedentry->arrivaltime=$request->arrivaltime;
        $preapprovedentry->status=$request->status;
        $preapprovedentry->statusdescription=$request->statusdescription;
        $preapprovedentry->save();
        return response()->json([
            "success" => true,
            "data" => $preapprovedentry,
        ]);
    }
public function viewpreapproveentryreports($userid)
{
    $preapproveentryreports= Preapproveentry::where('userid',"=",$userid)->orderBy('id', 'DESC')-> get();
    return response()->json([
        "success" => true,
        "data" => $preapproveentryreports,
    ]);
}
    public function updatepreapproveentrystatus(Request $request)
    {
        $isValidate = Validator::make($request->all(), [
            'id' => 'required|exists:preapproveentries,id',
            // 'cnic' => 'nullable',
            // 'mobileno' => 'nullable',
            'status' => 'required',
            'statusdescription' => 'required',
        ]);
        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false
            ], 403);
        }
        $preapproveentryreports = Preapproveentry::Find($request->id);
        $preapproveentryreports->status = $request->status;
        // $preapproveentryreports->cnic = $request->cnic;
        $preapproveentryreports->updated_at = Carbon::now()->addHour(5)->toDateTimeString();
        $preapproveentryreports->statusdescription = $request->statusdescription;
        $preapproveentryreports->update();
        return response()->json([
            "success" => true,
            "data" => $preapproveentryreports,
            "message" => "Status Updated Successfully"
        ]);
    }
public function getgatekeepers($subadminid)
{
    $gatekeeper=GateKeeper::
    where('subadminid',  $subadminid )->
    join('users','users.id','=','gatekeepers.gatekeeperid')->get();
    return response()->json([
        "success" => true,
        "data" => $gatekeeper,
    ]);
}
// public function getvisitorstypes()
// {
//     $visitortypes = Visitortype::all();
//     return response()->json([
//         "success" => true,
//         "data" => $visitortypes,
//     ]);
// }
// public function addvisitorstypes(Request $request)
// {
//     $isValidate = Validator::make($request->all(), [
//     'visitortype' => 'required',
// ]);

// if ($isValidate->fails()) {
//     return response()->json([
//         "errors" => $isValidate->errors()->all(),
//         "success" => false
//     ], 403);
// }
// $visitortypes = new Visitortype();
// $visitortypes->visitortype = $request->visitortype;
// $visitortypes->save();
//     return response()->json([
//         "success" => true,
//         "data" => $visitortypes,
//     ]);
// }

public function preapproveentryresidents($userid)
{
    $user= Preapproveentry::where('gatekeeperid','=',$userid)->join('users','users.id','=','preapproveentries.userid')->where('status',1)->orwhere('status',2)->distinct()->get();
    $res = $user->unique('userid');
    return response()->json([
        "success" => true,
        "data" => $res->values()->all(),
    ]);
}
public function preapproveentries($userid)
{
    $preapproveentries= Preapproveentry::where('userid','=',$userid)->where('status','!=',0)->where('status','!=',3) ->get();
    return response()->json([
        "success" => true,
        "data" => $preapproveentries,
    ]);
}
public function preapproventrynotifications($userid)
{
    $unapproveentries= Preapproveentry::where('gatekeeperid','=',$userid)->
    join('users','users.id','=','preapproveentries.userid')->where('status',0)->select(
        'preapproveentries.id',
        "users.firstname",
        "users.lastname",
        "users.cnic",
        "users.address",
        "users.mobileno",
        "users.roleid",
        "users.rolename",
        "users.image",
        'preapproveentries.gatekeeperid',
        'preapproveentries.userid',
        'preapproveentries.visitortype',
        'preapproveentries.name',
        'preapproveentries.description',
        'preapproveentries.cnic',
        'preapproveentries.mobileno',
        'preapproveentries.vechileno',
        'preapproveentries.arrivaldate',
        'preapproveentries.arrivaltime',
        'preapproveentries.status',
        'preapproveentries.statusdescription',
        // 'preapproveentries.created_at',
        // 'preapproveentries.updated_at',
    )->GET();
    return response()->json([
        "success" => true,
        "data" => $unapproveentries,
    ]);
}
}