<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{

    protected $fillable = [
        'slug',
        'name',
        'subject',
        'email_body',
        'sms_body',
        'shortcodes',
        'email_status',
        'sms_status',
    ];
}

