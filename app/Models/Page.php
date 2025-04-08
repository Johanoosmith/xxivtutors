<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
	use Sortable, SoftDeletes;
   
    protected $sortable = ['id','user_id','title','page_url','status','created_at'];

    protected $table = 'pages';

    protected $fillable = ['title','user_id','title','title_first','title_second','page_url','image','banner_video','template',
    'short_description','description','related','faqs','temp_status','featuredcategory_ids','appeals',
    'gallery_image_1','gallery_image_alt_1','gallery_image_2','gallery_image_alt_2',
    'gallery_image_3','gallery_image_alt_3','gallery_image_4','gallery_image_alt_4','gallery_image_5',
    'gallery_image_alt_5','status','meta_title','meta_description','slug',
        'description'];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];    

    public function pagemeta()
    {
        return $this->hasMany(Pagemeta::class);
    }
	
	public static function getPage($id_or_slug){
		$query = self::query();
		if(is_numeric($id_or_slug)){
			$query->where('id',$id_or_slug);
		}else{
			$query->where('page_url',$id_or_slug);
		}
		
		return $query->first();
	}
    
}
