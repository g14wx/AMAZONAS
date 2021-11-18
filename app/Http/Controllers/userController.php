<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
     public function getUser() :void
    {

        $user = User::find(1);

        echo $user->name;
    }
}
