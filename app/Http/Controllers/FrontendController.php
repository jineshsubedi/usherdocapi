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
        $queries = \App\Models\Post::leftjoin('categories', 'posts.cat_id','categories.id')->where('posts.title', 'LIKE', $term.'%')->where('posts.status', 'active');
                            // ->select('title')
        if(!Auth::user()){
        	$queries = $queries->where('posts.private', 0)->where('categories.private', 0);
        }
        $queries = $queries->select('posts.*')->groupBy('posts.title')
                            ->take(10)
                            ->get();
        
        foreach ($queries as $query)
        {
            $category = \App\Models\Category::getTitle($query->cat_id);
            $description = substr($query->description, 100);
            $htmlView = '<h3>'.$category.'</h3><h4>'.$query->title.'</h4><p>'.$description.'</p>';
            $results[] = [ 
                'id' => $query->id,
                'value' => $query->title, 
                'category' => $category,
                'slug' => $query->slug, 
                'description' => $query->description
            ];
        }
        return response()->json($results);
    }
}