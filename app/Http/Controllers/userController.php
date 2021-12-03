<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Psy\Util\Json;

class userController extends Controller
{
     public function greeting() :JsonResponse
    {
      return response()->json(["msg"=>"Hello"]);
    }

    public function hour() :JsonResponse
    {
        return response()->json(["hour"=>Carbon::today()->toString()]);
    }

    public function users() : JsonResponse
    {
        $users= User::all();

        if ($users != null)
        {
            return response()->json($users);
        }else{
            return response()->json([
                "msg"=>"Empty"
            ]);
        }

    }

    public function allUsers() : JsonResponse
    {
        $users= User::all();

        if ($users != null)
        {
            return response()->json($users);
        }else{
            return response()->json([
                "msg"=>"Empty"
            ]);
        }

    }
}
