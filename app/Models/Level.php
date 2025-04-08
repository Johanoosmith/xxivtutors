<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['title', 'status'];
	
	
	public static function getLevelList($ids = NULL){
		
		$levelObj = Level::where('status',1)->orderBy('title','ASC');
		if(!empty($ids)){
			$levelObj->whereIn('id', $ids);
		}
		$levels = $levelObj->get()->pluck('title','id');
		return $levels;
	}

}
