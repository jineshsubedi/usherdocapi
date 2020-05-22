<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title','slug','status','cat_id','child_cat_id','description', 'tab_ids','priority', 'private'];

    public function getSlug($str){
        $slug=str_slug($str);
        $exits=$this->where('slug',$slug)->count();
        if($exits>0){
            $slug .=date('Ymdhis').random(2,100);
        }
        return $slug;
    }
    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id')->where('status', 'active');
    }
    public function getAllPost(){
        return $this->with('cat_info')->orderBy('cat_id','asc')->paginate(50);
    }
    public static function getFirstChildSlug($cat_id)
    {
        $data = Post::where('cat_id', $cat_id)->where('status', 'active')->orderBy('id')->first();
        if($data)
        {
            return $data->slug;
        }
        return '';
    }
    public static function countActivePost()
    {
        $data = Post::where('status', 'active')->count();
        if($data)
        {
            return $data;
        }
        return 0;
    }

    
}