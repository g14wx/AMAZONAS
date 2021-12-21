<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Psy\Util\Json;

class userController extends Controller
{
    public function hour() :JsonResponse
    {
        return response()->json(["hour"=>Carbon::today()->toString()]);
    }


    public function newep() :JsonResponse
    {
        return response()->json(["Hello, i am a end-point"]);
    }


}
