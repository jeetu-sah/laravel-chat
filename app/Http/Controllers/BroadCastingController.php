<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Broadcast;

class BroadCastingController extends Controller
{
    
    function __invoke(Request $req) {
        return Broadcast::auth($req);
    }

}
