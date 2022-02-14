<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index() {
        return view( 'home' );
    }

    public function chatUserList() {
        if ( Auth::check() ) {
            $userList = User::where([['id','!=',Auth::user()->id]])->get();
            if ( $userList->count() > 0 ) {
                return response()->json( [ 'status' => 200, 'userList' =>$userList ] );
            }
        } else {
            return response()->json( [ 'status' => 100 ] );
        }
    }
}
