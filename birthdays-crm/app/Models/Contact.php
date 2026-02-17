<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'notes',
        'telephone1',
        'telephone2',
        'telephone3',
        'email',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function messageLogs()
    {
        return $this->hasMany(MessageLog::class);
    }
}
