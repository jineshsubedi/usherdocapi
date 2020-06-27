<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    protected $category=null;
    public function __construct(Category $category){
        $this->category=$category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_cats=$this->category->orderBy('priority','asc')->paginate(100);
        return view('backend.category.index')->with('category',$all_cats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats=$this->category->pluck('title','id');
        return view('backend.category.create')->with('parent_cats',$parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string',
            'priority'=>'required|integer',
            'status'=>'required|in:active,inactive'
        ]);

        
        $data=$request->all();
        $data['slug']=$this->category->getSlug($request->title);
        $data = [
            'title' => $request->title,
            'priority' => $request->priority,
            'slug' => $data['slug'],
            'status' => $request->status,
            'private' => $request->privacy
        ];
        $status=Category::create($data);
        if($status){
            request()->session()->flash('success','Category successfully added');
        }
        else{
            request()->session()->flash('error','Error while adding category');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->category=$this->category->findOrFail($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found');
            return redirect()->route('category.index');
        }
        $parent_cats=$this->category->get();
        return view('backend.category.edit')
        ->with('parent_cats',$parent_cats)
        ->with('category_data',$this->category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|string',
            'priority'=>'required|integer',
            'status'=>'required|in:active,inactive'
        ]);
        $this->category=$this->category->findOrFail($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found');
            return redirect()->route('category.index');
        }
        $data=[
            'title' => $request->title,
            'priority' => $request->priority,
            'status' => $request->status,
            'private' => $request->privacy
        ];
        $status=Category::findOrFail($id)->update($data);
        if($status){
            request()->session()->flash('success','Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error while updating category');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category=$this->category->findOrFail($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found');
            return redirect()->route('category.index');
        }
        $del=$this->category->delete();
        if($del){
            request()->session()->flash('success','Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting category');
        }
        return redirect()->route('category.index');
    }

    public function getChildByParent(Request $request){
        // dd($request->all());
        $this->category=$this->category->findOrFail($request->id);
        if(!$this->category){
            return response()->json(['status'=>false,'msg'=>'Category not found','data'=>null]);
        }
        $child_cat=$this->category->getChildByParentId($request->id);
        if($child_cat->count()<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]); 
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }

}
