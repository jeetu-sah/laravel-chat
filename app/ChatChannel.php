<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatChannel extends Model
{
    protected $table = 'chat_channels';
    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'chat_status',
        'created_at',
        'updated_at',
    ];


    public function sender_detail()
    {
        return $this->belongsTo('App\User' , 'sender_id');
    }

    public function receiver_detail()
    {
        return $this->belongsTo('App\User' , 'receiver_id');
    }


    
}
