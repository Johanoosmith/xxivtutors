<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'county';

    // Define fillable fields
    protected $fillable = ['name'];
	
    public function tutors()
    {
        return $this->hasMany(Tutor::class, 'county');
    }
	
	public static function getList(){
		return self::orderBy('name','ASC')->get()->pluck('name','id')->toArray();
	}

    public static function getCountyNameById($county_id){
		$county = self::where('id',$county_id)->first();
        return $county->name;
	}
}