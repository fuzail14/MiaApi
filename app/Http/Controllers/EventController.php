<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\User;
use App\Notifications\EventNotifications;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function addevent(Request $request)
    {
        $isValidate = Validator::make($request->all(), [
            'userid' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'active' => 'required'
        ]);
        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false
            ], 403);
        }
        $event = new Event();
        $event->userid = $request->userid;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->startdate =  Carbon::parse($request->startdate)->format('Y-m-d');
        $event->enddate = Carbon::parse($request->enddate)->format('Y-m-d');
        $event->active = $request->active;
        $event->save();
        // $user = User::all();
        // // foreach($user as $u)
        // // {
        // // $s= $u->firstname;
        // //  var_dump($s);
        // // }
        // // echo($varr);
        // $tk = 'ct99wz8wTeemXnjYoM0KCe:APA91bEj3t_hU0LKRPCS6lVsvMHJDj_Yg4ES_OneTJBJSgxNi10Wlxpff5ZSX9eVYgZzAyoYP6k6EkGJNI0t2LHJyf39eCGkFAhMiHhU3gSGsAPc75Yz7cpjZ6MnY_KT_V7a_DhlOmdb';
        // $tk1 = 'fHgpOVJBSKClU_yOMhR81g:APA91bHdJ-rg-EVlczuckjwhxS_jL3baO37cbhZj_g7BSvfTV74zgp6GX1IIwX3OX8as4Ka52_aT6bLR6_K3EguZvIA29Z19rf97pHZ5dZ_7GIu_a81-6brFocLLKpNgI4Es1nFBApUq';
        // $tk2 = 'cSxb9-tvSMil-hn_mQXVhJ:APA91bF7Qm38y5CNqRZLRx6pSAJPkagCgZCDwgGu7O7D2BIPnjFm0iO6gdp2e0Wms-GnvaELtwnz0G5G_A-BnsVWzTb5LwLpXfx4-2wZ_Q1QXxmUfms4y_Z3Qhf8fIHCq8QO4lykqbVB';
        // $tk3 = 'cugSpzVDQmqj85UGvTJW8Q:APA91bEt0daEPj1XKFf6UYhvTVE0qls8T_uNJOvZUW6RD_BjlcK-QVln-h23HrpxMufmA12px-v8UZnkuJ68NHHWWZvnMBud86DDhH0L31lYkadxXtdtKxrij2khffgkP8EZKmXyQkA2';
        // $serverkey = 'AAAAcuxXPmA:APA91bEz-6ptcGS8KzmgmSLjb-6K_bva-so3i6Eyji_ihfncqXttVXjdBQoU6V8sKilzLb9MvSHFId-KK7idDwbGo8aXHpa_zjGpZuDpM67ICKM7QMCGUO_JFULTuZ_ApIOxdF3TXeDR';
        // $url = 'https://fcm.googleapis.com/fcm/send';
        // $mydata = [
        //     'registration_ids' => [$tk, $tk1, $tk2, $tk3],
        //     "data" => $event,
        //     "android" => [
        //         "priority" => "high",
        //         "ttl" => 60 * 60 * 1,
        //     ],
        //     "notification" => [
        //         'title' => $event->title, 'body' => $event->description,
        //         'description' => "jani"
        //     ]
        // ];
        // $finaldata = json_encode($mydata);
        // $headers = array(
        //     'Authorization: key=' . $serverkey,
        //     'Content-Type: application/json'
        // );
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $finaldata);
        // $result = curl_exec($ch);
        // // var_dump($result);
        // curl_close($ch);
        // if (auth()->user()) {
        //     $users = User::find(auth()->user()->id);
        //     $users->notify(new  EventNotifications($event));
        // }
        return response()->json(["data" => $event]);
    }
    public function addeventimages(Request $request)
    {
        $files = $request->file();
        dd($files);
    }
    //     $isValidate = Validator::make(
    //         $request->all(), [
    //         'eventid' => 'required|exists:events,id',
    //         'image' => 'required',
    //     ]);
    //     if ($isValidate->fails()) {
    //         return response()->json([
    //             "errors" => $isValidate->errors()->all(),
    //             "success" => false
    //         ], 403);
    //     }
    //     $event = new Event();
    //     if($request->files->has('image'))
    //     {
    //         $images = $request->files->get('image');
    //         dd($images);
    //        foreach( $images as $image)
    //        {
    //         // print($images);
    //         $image = $request->files->get('image');
    //         $filename = time() . "." . $image->extension();
    //         $image->move(public_path('/storage/'), $filename);
    //            $event->eventid=$request->eventid;
    //            $event->image=$filename;
    //            $event->save();
    //        }
    //        return response()->json(["data" => $event]);
    //     }
    //     }
    public function events($userid)
    {
        // dd($userid);
        $event = Event::where('userid', $userid)->get();
        return response()->json(["data" => $event]);
    }
    public function deleteevent($id)
    {
        // dd($userid);
        $event = Event::where('id', $id)->delete();
        if ($event == 1) {
            return response()->json([
                "success" => true,
                "message" => "event deleted successfully"
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "failed to delete event"
        ], 403);
    }
    public  function updateevent(Request $request)
    {
        $isValidate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'active' => 'required',
            'id' => 'required|exists:events,id',
        ]);
        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false
            ], 403);
        }
        $event = Event::find($request->id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->startdate =  Carbon::parse($request->startdate)->format('Y-m-d');
        $event->enddate = Carbon::parse($request->enddate)->format('Y-m-d');
        $event->active = $request->active;
        $event->update();
        return response()->json([
            "success" => true,
            "data" => $event,
            "message" => "event details update successfully"
        ]);
    }
}
    // Activity::orderBy('created_at','desc')->get();