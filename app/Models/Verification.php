<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{

    protected $fillable = [
        'user_id',
        'document_type',
        'dbs_number',
        'firstname_on_doc',
        'lastname_on_doc',
        'othername_on_doc',
        'country_id',
        'expire_date',
        'file',
        'status',
        'reject_reason',
        'verification_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
