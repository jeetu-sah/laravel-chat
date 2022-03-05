<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use SoftDeletes;

    protected $table = 'messages';
    
    protected $fillable = [
        'id',
        'chat_channel_id',
        'sender_id',
        'messages',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $touches = ['chatChannels'];

    /**
     * Get the post that the comment belongs to.
     */
    public function chatChannels()
    {
        return $this->belongsTo(ChatChannel::class , 'chat_channel_id');
    }


}
