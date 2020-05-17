@extends('backend.layouts.master')
@section('title','Admin || Dashboard')
@section('main-content')
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Post List</div>
            </div>
            <div class="ibox-body">
               <form action="{{route('post.store')}}" method="POST">
                {{-- @csrf --}}
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Enter title name" class="form-control" value="{{old('title')}}">
                        @if($errors->has('title'))
                            <span class="text-danger">
                                <strong>{{$errors->first('title')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control" id="category_id">
                            <option value="">Select Categories</option>
                            @foreach($parent_cats as $key=>$cats)
                                <option value="{{$cats->id}}" @if(old('category_id') == $cats->id) selected @endif>{{$cats->title}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category_id'))
                            <span class="text-danger">
                                {{$errors->first('category_id')}}
                            </span>
                        @endif
                    </div>

                    {{-- <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" placeholder="Enter slug name" class="form-control">
                    </div> --}}

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" id="description" name="description" placeholder="Text description" rows=6 class="form-control" value="{{old('description')}}"></textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">
                                {{$errors->first('description')}}
                            </span>

                        @endif
                    </div>

                    

                    <div class="form-group">
                        <h4>Select Required Tab</h4>
                        <div class="row">
                            @foreach($tabs as $tab)
                            <div class="col-md-2">
                                <input type="checkbox" name="tab_ids[]" id="tabcheckbox{{$tab->id}}" value="{{$tab->id}}"> {{$tab->title}}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <input type="number" class="form-control" name="priority" placeholder="Enter number" value="{{old('priority')}}">
                        @if($errors->has('priority'))
                            <span class="text-danger">
                                <strong>{{$errors->first('priority')}}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <button type="reset" class="btn btn-info">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{url('admin/post')}}" class="btn btn-danger">Cancel</a>

                </form>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <footer class="page-footer">
            <div class="font-13">{{date('Y')}} © <b>{{env('APP_NAME')}}</b> - All rights reserved.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </footer>
</div>
@endsection

@section('styles')
    <link href="{{asset('/summernote/summernote.min.css')}}" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('/summernote/summernote.min.js')}}"></script>


    <script>
         $('#description').summernote({
             height:150,
             placeholder:'Description'
         });
    </script>
    
@endsection