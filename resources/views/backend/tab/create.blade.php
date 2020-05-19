@extends('backend.layouts.master')
@section('title','Admin || Dashboard')
@section('main-content')
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Tab List</div>
            </div>
            <div class="ibox-body">
               <form action="{{route('tab.store')}}" method="POST">
                {{-- @csrf --}}
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Title <sup style="color:red;">*</sup></label>
                        <input type="text" name="title" placeholder="Enter title name" class="form-control" value="{{old('title')}}" >
                        @if ($errors->has('title'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="type">Type <sup style="color:red;">*</sup></label>
                        <select name="type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="table" @if(old('type') == 'table') selected @endif>Table</option>
                            <option value="snippet" @if(old('type') == 'snippet') selected @endif>Snippet</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority <sup style="color:red;">*</sup></label>
                        <input type="number" class="form-control" name="priority" placeholder="Enter number" value="{{old('priority')}}">
                        @if ($errors->has('priority'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('priority') }}</strong>
                            </span>
                        @endif
                    </div>
                  
                    <div class="form-group">
                        <label for="status">Status <sup style="color:red;">*</sup></label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <button type="reset" class="btn btn-info">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{url('admin/tab')}}" class="btn btn-danger">Cancel</a>

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
    {{-- <script>
        $('#cat_id').change(function(){
            var cat_id=$(this).val();
            // alert(cat_id);
            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"tab",
                    data:{
                        _token:"{{csrf_token()}}"
                        // '_token': $('input[name=_token]').val(),
                    },
                    success:function(response){
                        console.log(response);

                        // if(typeof(response)!='object'){
                        //     response=$.parseJSON(response);
                        // }
                        // var html_option="<option value=''>--Select any one--</option>";
                        // if(response.status){
                        //     var data=response.data;
                        //     if(response.data){
                        //         $('#child_cat_div').removeClass('d-none');
                        //         $.each(data,function(id,title){
                        //             html_option += "<option value='"+id+"'>"+title+"</option>";
                        //         });
                        //     }
                        //     else{
                        //         console.log('no response data');
                        //     }
                        // }
                        // else{
                        //     $('#child_cat_div').addClass('d-none');
                        // }
                        // $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }
        })
    </script> --}}
@endsection