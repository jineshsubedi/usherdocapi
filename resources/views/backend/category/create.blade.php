@extends('backend.layouts.master')
@section('title','Admin || Dashboard')
@section('main-content')
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Category List</div>
            </div>
            <div class="ibox-body">
               <form action="{{route('category.store')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Category Name <sup style="color:red;">*</sup></label>
                        <input type="text" name="title" placeholder="Enter category name" class="form-control" value="{{old('title')}}">
                        @if($errors->has('title'))
                            <span class="text-danger">
                                <strong>{{$errors->first('title')}}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority <sup style="color:red;">*</sup></label>
                        <input type="number" class="form-control" name="priority" placeholder="Enter number" value="{{old('priority')}}">
                        @if($errors->has('priority'))
                            <span class="text-danger">
                                {{$errors->first('priority')}}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status">Status <sup style="color:red;">*</sup></label>
                        <select name="status" class="form-control">
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Privacy <sup style="color:red;">*</sup></label>
                        <select name="privacy" class="form-control">
                            <option value="0">Public</option>
                            <option value="1">Private</option>
                        </select>
                    </div>
                    <button type="reset" class="btn btn-info">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{url('admin/category')}}" class="btn btn-danger">Cancel</a>

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
    <style>
        label{
            font-weight: 600;
        }
    </style>
@endsection
@section('scripts')

  
    <script>
        //  alert('is_checked');
         $('#is_parent').change(function(){
             var is_checked=$('#is_parent').prop('checked');
             if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_id').val('');
             }
             else{
                 $('#parent_cat_div').removeClass('d-none');
             }
         });
    </script>
@endsection