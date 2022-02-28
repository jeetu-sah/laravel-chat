<?php

use Illuminate\Support\Facades\Broadcast;
use App\ChatChannel;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('chat.{chatBodyId}', function ($user , $chatBodyId) {
    $channelResponse = ChatChannel::find($chatBodyId);
    if((Auth::user()->id == $channelResponse->sender_id) ||  (Auth::user()->id  == $channelResponse->receiver_id)){
        return true;
    }else{
        return false;
    } 
});
