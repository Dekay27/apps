<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
    protected $fillable = [
        'contact_id',
        'birthday_for',
        'phone',
        'message',
        'status',
        'sent_at',
        'response',
    ];

    protected $casts = [
        'birthday_for' => 'date',
        'sent_at' => 'datetime',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function getSentStatusAttribute(): string
    {
        return $this->status === 'sent' ? 'Sent' : ucfirst($this->status);
    }
}
