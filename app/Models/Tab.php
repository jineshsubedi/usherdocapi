<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    protected $fillable=['title','status','type','priority'];

    public function getTypeByTitle($title){
        // debugger();
        return $this->where('id',$title)->pluck('type','id');
    }

    public static function getTabs($tab_ids)
    {
    	$ids = json_decode($tab_ids);
    	$data = Tab::whereIn('id', $ids)->orderBy('priority', 'asc')->get();
    	return $data;
    }
    public static function countActiveTab()
    {
        return Tab::where('status', 'active')->count();
    }
}