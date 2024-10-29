<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZoomMeeting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'host_id',
        'meeting_id',
        'meeting_name',
        'description',
        'password',
        'start_date_time',
        'end_date_time',
        'start_link',
        'join_link',
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}
