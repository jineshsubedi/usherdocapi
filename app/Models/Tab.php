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
    	$data = Tab::whereIn('id', $ids)->where('status', 'active')->orderBy('priority', 'asc')->get();
    	return $data;
    }
    public static function countActiveTab()
    {
        $data = Tab::where('status', 'active')->count();
        if($data)
        {
            return $data;
        }
        return 0;
    }
}