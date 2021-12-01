<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class userController extends Controller
{
     public function getGreeting() :JsonResponse
    {
      return response()->json(["msg"=>"Hello"]);
    }
}
