<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ChatChannel;
use Auth;
use phpDocumentor\Reflection\Types\Null_;

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

    public function userList(){
        if ( Auth::check() ) {
            $userLists = User::where([['id','!=',Auth::user()->id]])->get();
            if($userLists->count() > 0){
                return response()->json( [ 'status' => 200, 'userList' =>$userLists ] );
            }else {
                return response()->json( [ 'status' => 100 ] );
            }
        } else {
            return response()->json( [ 'status' => 100 ] );
        }
    }

    public function chatUserList() {
        if ( Auth::check() ) {
            $userLists = ChatChannel::where('sender_id',Auth::user()->id)
                                    ->orwhere('receiver_id',Auth::user()->id)
                                    ->get();
            if($userLists->count() > 0){
                $usersLists = $userLists->map(function($user){
                    if($user->sender_id == Auth::user()->id){
                        $user->friend_details = $user->receiver_detail;
                    }else {
                         $user->friend_details = $user->sender_detail;
                    }
                    return $user;
                });
                return response()->json( [ 'status' => 200, 'userList' =>$userLists ] );
            }else {
                return response()->json( [ 'status' => 100 ] );
            }
        } else {
            return response()->json( [ 'status' => 100 ] );
        }
    }



    public function createChannel() {
        if ( Auth::check() ) {
            $existUser = ChatChannel::where( [ [ 'sender_id', '=', Auth::user()->id],
                                                [ 'receiver_id', '=', request()->id ] ] )
                                                ->orWhere( [ [ 'sender_id', '=', request()->id ],
                                                [ 'receiver_id', '=', Auth::user()->id ] ] )
                                                ->first();
            if($existUser == Null){
                $createChannel = ChatChannel::create(['sender_id'=>Auth::user()->id, 'receiver_id'=>request()->id]);
                if($createChannel){
                     return response()->json( [ 'status' => 200 ] );
                }else {
                    return response()->json( [ 'status' => 100 ] );
                }
            }else{
                return response()->json( [ 'status' => 200 ] );
            }
        }
    }
}
