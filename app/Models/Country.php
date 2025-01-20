<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the model's plural name
    protected $table = 'countries';

    // If your primary key is something other than 'id', define it here
    // protected $primaryKey = 'country_id';

    // If you don't use timestamps, set this to false
    public $timestamps = true;

    // Optionally, specify the fields that can be mass-assigned
    protected $fillable = ['name']; // Adjust the fields as per your table columns
}
