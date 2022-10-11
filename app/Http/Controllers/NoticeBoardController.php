<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Notice;

use Carbon\Carbon;



class NoticeBoardController extends Controller
{
    public function addnoticeboarddetail(Request $request)
    {

        $isValidate = Validator::make($request->all(), [
            'noticetitle' => 'required|string',
            'noticedetail' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',

            'starttime' => 'required|after:' . Carbon::now()->format('H:i:s'),
            'endtime' => 'required|after:start_time',

            
            

            'status' => 'required',


            'subadminid' => 'required|exists:users,id',

        ]);

        if ($isValidate->fails()) {

            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false



            ], 403);
        }


        $notice = new Notice();

        $notice->noticetitle = $request->noticetitle;
        $notice->noticedetail = $request->noticedetail;

        $notice->startdate =  Carbon::parse($request->startdate)->format('m-d-y');
        $notice->enddate =  Carbon::parse($request->enddate)->format('m-d-y');
        
        $notice->starttime = $request->starttime;
        $notice->endtime = $request->endtime;


        $notice->status = $request->status;

        $notice->subadminid = $request->subadminid;

        $notice->save();


        return response()->json([
            'message' => 'success',
            'data' => $notice
        ], 200);
    }


    public function viewallnotices($subadminid)

    {



        $notice = Notice::where('subadminid', $subadminid)->get();


        return response()->json(["NoticeList" => $notice]);
    }


    public function deletenotice($id)

    {
        $notice =   Notice::find($id);




        if ($notice != null) {



            $notice = Notice::where('id', $id)->delete();


            return response()->json([
                'data' => true,
                "data" => $notice, "message" => "delete Notice successfully"
            ], 200);
        } else {
            return response()->json([
                
                "data" => false,
                
                "message" => "Notice Not deleted"
            ]);
        }
    }



    public  function updatenotice(Request $request)


    {
        $isValidate = Validator::make($request->all(), [
            'noticetitle' => 'required|string',
            'noticedetail' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',

            'starttime' => 'required|after:' . Carbon::now()->format('H:i:s'),
            'endtime' => 'required|after:start_time',
            

            'status' => 'required',


            'id' => 'required|exists:notices,id',



        ]);


        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false

            ], 403);
        }


        $notice = Notice::find($request->id);

        $notice->noticetitle = $request->noticetitle;
        $notice->noticedetail = $request->noticedetail;

        
        $notice->startdate =  Carbon::parse($request->startdate)->format('m-d-y');
        $notice->enddate =  Carbon::parse($request->enddate)->format('m-d-y');
        
        $notice->starttime = $request->starttime;
        $notice->endtime = $request->endtime;
        
        $notice->status = $request->status;



        $notice->save();






        return response()->json([
            "success" => true,
            "data" => $notice,
            "message" => "notice update successfully"
        ]);
    }


    
}
