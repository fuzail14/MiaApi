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
            'date' => 'required|date',
            //'time' => 'required',

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

        $notice->date =  Carbon::parse($request->date)->format('m-d-y');
        //$notice->time = $request->time;
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


        return response()->json(["data" => $notice]);
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
                'message' => 'error',
                "data" => false
            ]);
        }
    }



    public  function updatenotice(Request $request)


    {
        $isValidate = Validator::make($request->all(), [
            'noticetitle' => 'required|string',
            'noticedetail' => 'required|string',
            'date' => 'required|date',
            //'time' => 'required',

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

        $notice->date =  Carbon::parse($request->date)->format('m-d-y');
        //$notice->time = $request->time;
        $notice->status = $request->status;



        $notice->save();






        return response()->json([
            "success" => true,
            "data" => $notice,
            "message" => "notice update successfully"
        ]);
    }


    
}
