<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ChatChannel;
use Auth;
use App\Messages;
use phpDocumentor\Reflection\Types\Null_;
use App\Events\SentMessages;

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
                                    ->orderBy('updated_at','DESC')
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
            $existUser = ChatChannel::where([['sender_id','=',Auth::user()->id],
                                                ['receiver_id','=',request()->id ] ] )
                                                ->orWhere([['sender_id','=',request()->id ],
                                                [ 'receiver_id','=',Auth::user()->id ] ] )
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

    public function sendMsg(){
        if(!empty(request()->msgText)){
            $chatChannel = ChatChannel::find(request()->activeChatTabId);
            if($chatChannel != NULL){
                $saveResponse = Messages::create(['chat_channel_id'=>request()->activeChatTabId,
                                                    'sender_id'=>Auth::user()->id,
                                                    'messages'=>request()->msgText,
                                                    'status'=>'read']);
                if($saveResponse){
                    broadcast(new SentMessages($saveResponse));
                    return response()->json( [ 'status'=>200,'chat'=>$saveResponse]);
                }else{
                    return response()->json( [ 'status'=>100]);
                }
            }else{
                return response()->json( [ 'status'=>100]);
            }
       }else {
           return response()->json( [ 'status' => 100 ] );
       }
    }


    public function activeUserChats(){
        if(Auth::check()){
            $chatChannel = ChatChannel::with(['message'])->find(request()->id);
            if($chatChannel){
                   return response()->json( [ 'status' => 200 , 'chats'=>$chatChannel ] );
            }else{
                return response()->json( [ 'status' => 100 ] );
            }
        }else {
              return response()->json( [ 'status' => 100 ] );
        }
    }
}
