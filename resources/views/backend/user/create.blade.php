@extends('backend.layouts.master')
@section('title','Admin || Dashboard')
@section('main-content')
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">User List</div>
            </div>
            <div class="ibox-body">
               <form action="{{route('user.store')}}" method="POST">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name <sup style="color:red;">*</sup></label>
                        <input type="text" name="name" placeholder="Enter name" class="form-control" value="{{old('name')}}" >
                        @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="email">Email <sup style="color:red;">*</sup></label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{old('email')}}" autocomplete="off">
                        @if ($errors->has('email'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password <sup style="color:red;">*</sup></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="role">Role <sup style="color:red;">*</sup></label>
                        <select name="role" class="form-control">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @if ($errors->has('role'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('role') }}</strong>
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
                  
                    <button type="reset" class="btn btn-info">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{url('admin/user')}}" class="btn btn-danger">Cancel</a>

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