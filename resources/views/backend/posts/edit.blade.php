@extends('backend.layouts.master')
@section('title','Admin || Dashboard')
@section('main-content')
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Update Post</div>
            </div>
            <div class="ibox-body">
               <form action="{{route('post.update',$post_data->id)}}" method="POST">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                    <div class="form-group">
                        <label for="title">Title <sup style="color:red;">*</sup></label>
                        <input type="text" name="title" value="{{$post_data->title}}" placeholder="Enter title name" class="form-control">
                        @if($errors->has('title'))
                            <span class="text-danger">
                                {{$errors->first('title')}}
                            </span>

                        @endif
                    </div>

                    {{-- <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" value="{{$post_data->slug}}" placeholder="Enter slug name" class="form-control">
                    </div> --}}

                    <div class="form-group">
                        <label for="description">Description <sup style="color:red;">*</sup></label>
                        <textarea type="text" id="description" name="description" placeholder="Text description" rows=6 class="form-control">{{$post_data->description}}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">
                                {{$errors->first('description')}}
                            </span>

                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Category <sup style="color:red;">*</sup></label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                            @foreach($parent_cats as $parent_cat)
                                <option value="{{$parent_cat->id}}" {{($post_data->cat_id==$parent_cat->id)? 'selected' : ''}}>{{$parent_cat->title}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category_id'))
                            <span class="text-danger">
                                {{$errors->first('category_id')}}
                            </span>
                        @endif
                    </div>
                    <div class="form-group d-none" id="child_cat_div">
                        <label for="child_cat_id">Sub Category</label>
                        <select class="form-control" name="child_cat_id" id="child_cat_id">
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <h4>Select Required Tab <sup style="color:red;">*</sup></h4>
                        <div class="row">
                            @if(count($tabs) > 0)
                            @foreach($tabs as $tab)
                            <div class="col-md-2">
                                @if(in_array($tab->id, $tab_ids))
                                <input type="checkbox" name="tab_ids[]" id="tabcheckbox{{$tab->id}}" value="{{$tab->id}}" @if(is_array(old('tab_ids')) && in_array($tab->id, old('tab_ids'))) checked @endif checked> {{$tab->title}}
                                @else
                                <input type="checkbox" name="tab_ids[]" id="tabcheckbox{{$tab->id}}" value="{{$tab->id}}" @if(is_array(old('tab_ids')) && in_array($tab->id, old('tab_ids'))) checked @endif> {{$tab->title}}
                                @endif
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority <sup style="color:red;">*</sup></label>
                        <input type="number" class="form-control" name="priority"  value="{{$post_data->priority}}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status <sup style="color:red;">*</sup></label>
                        <select name="status" class="form-control">
                            <option value="active" {{($post_data->status=='active') ? 'selected' : ''}}>active</option>
                            <option value="inactive" {{($post_data->status=='inactive') ? 'selected' : ''}}>inactive</option>
    
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
    <script>
        $('#cat_id').change(function(){
            var cat_id=$(this).val();
            // alert(cat_id);
            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        // _token:token,
                        // parameter:value,
                        '_token': $('input[name=_token]').val(),
                    },
                    success:function(response){
                        console.log(response);

                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Select any one--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"'>"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }
        })
    </script>
@endsection