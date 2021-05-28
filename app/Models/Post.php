<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
      'title','description','contents','published_at','image','category_id','slug'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    /**
     * delete post image
     * @return void
     */
    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopePostsFilter($query){

        if (request()->query('category')){
            //get category
            $category = Category::where('slug',request()->query('category'))->first();

            if ($category){
                return $query->where('category_id',$category->id);
            }
            return $query;
        }
        return $query;
    }

}


