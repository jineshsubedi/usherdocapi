<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Category;
class FrontendController extends Controller
{
    protected $category=null;
    public function __construct(Category $category){
        $this->category=$category;
    }
    public function home(){
        
        $all_category = Category::where('status', 'active')->orderBy('priority','ASC')->with('post')->get();

        return view('frontend.index')->with('categories',$all_category);
    }

    public function search(Request $request)
    {
    	$results = array();
        $term = $request->term;
        $queries = \App\Models\Post::where('title', 'LIKE', $term.'%')->where('status', 'active');
                            // ->select('title')
        if(!Auth::user()){
        	$queries = $queries->where('private', 0);
        }
        $queries = $queries->groupBy('title')
                            ->take(10)
                            ->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->title, 'slug' => $query->slug ];
        }
        return response()->json($results);
    }
}