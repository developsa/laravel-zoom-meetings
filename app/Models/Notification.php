<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function  scopeForUser($query, $userId)
    {
        return $query->where(function ($query) use ($userId) {
            $query->where('data->creator_id', $userId)->orWhere('data->host_id', $userId);
        });
    }
}
