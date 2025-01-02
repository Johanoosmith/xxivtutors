<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'name', 'slug', 'image', 'description', 'status', 
        'meta_title', 'meta_description',
    ];


    public function getNavigation(){
        return Category::where('status', 1)
             ->orderBy('order', 'asc')
             ->get();
    }
}