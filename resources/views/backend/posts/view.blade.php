@extends('backend.layouts.master')
@section('title','Admin || Dashboard')
@section('main-content')
<div class="content-wrapper">
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.layouts.notification')
                </div>
            </div>
            <div class="ibox-head">
                <div class="ibox-title">Post View</div>
                <div class="ibox-title float-right">
                    {{-- <a href="{{route('post.create')}}" class="btn btn-success btn-sm float-right">Add Post</a> --}}
                </div>
            </div>
            <div class="ibox-body">
                <h4>{{$post->title}}</h4>
                <p>{!! $post->description !!}</p>
                <div id="tabSection">
                   <div class="row">
                        <div class="col-md-10">
                          
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                @foreach($tabs as $key=>$tab)
                                  <li class="nav-item" id="tab{{$tab->id}}">
                                      <a class="nav-link" href="#tabBtn{{$tab->id}}" role="tab" data-toggle="tab" aria-selected="true">{{$tab->title}}</a>
                                  </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="openPostTabModel()">Add Post-Tab</button>
                        </div> 
                    </div>     
                    
                    <div class="tab-content">
                        @foreach($tabs as $k=>$tab)
                        <div class="tab-pane" id="tabBtn{{$tab->id}}">
                            @if($tab->type=='table')
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    @php($contents = \App\Models\PostTab::getData($post->id, $tab->id))
                                    @foreach($contents as $content)
                                    <tr>
                                        <td>{{$content->parameter}}</td>
                                        <td>{{$content->description}}</td>
                                        <td>
                                            <form action="{{route('post.tab.delete', $content->id)}}" method="post">
                                                {{csrf_field()}}
                                                 {{method_field('DELETE')}}
                                                <button type="button" class="btn btn-xs btn-warning" onclick="openPostTabTableTypeModel({{$content->id}})"><i class="fa fa-edit"></i></button>
                                                <button type="submit" class=" btn btn-xs btn-danger" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    <div class="modal" tabindex="-1" role="dialog" id="postTabEditModel{{$content->id}}">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Post Tab Manager</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form action="{{route('post-tab-edit', $content->id)}}" method="post">
                                          <div class="modal-body">
                                                {{csrf_field()}}
                                                 {{method_field('PUT')}}
                                                <input type="hidden" name="post_id" value="{{$content->post_id}}">
                                                <input type="hidden" name="tab_id" value="{{$content->tab_id}}">
                                                <input type="hidden" name="tab_type" value="{{$content->tab_type}}">
                                                <div class="form-group">
                                                    <label>Parameter</label>
                                                    <input type="text" name="parameter" class="form-control" value="{{$content->parameter}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" id="description" rows="5" class="form-control">{{$content->description}}</textarea>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    @endforeach
                                </table>
                            @endif
                            @if($tab->type=='snippet')
                                <table class="table table-bordered" style="width:100%">
                                    <tr>
                                        <th>Title</th>
                                        <th style="width:50px">Code</th>
                                        <th>Action</th>
                                    </tr>
                                    @php($contents = \App\Models\PostTab::getData($post->id, $tab->id))
                                    @foreach($contents as $content)
                                    <tr style="width:30%;">
                                        <td>{{$content->title}}</td>
                                        <td style="max-width:720px"><div class="pre"><pre style="overflow:auto;white-space:nowarp">{{json_decode($content->snippet)}}</pre></div></td>
                                        <td>
                                            <form action="{{route('post.tab.delete', $content->id)}}" method="post">
                                                {{csrf_field()}}
                                                 {{method_field('DELETE')}}
                                                 <button type="button" class="btn btn-xs btn-warning" onclick="openPostTabCodeTypeModel({{$content->id}})"><i class="fa fa-edit"></i></button>
                                                <button type="submit" class=" btn btn-xs btn-danger" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    <div class="modal" tabindex="-1" role="dialog" id="postTabEditModel{{$content->id}}">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Post Tab Manager</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form action="{{route('post-tab-edit', $content->id)}}" method="post">
                                          <div class="modal-body">
                                                {{csrf_field()}}
                                                 {{method_field('PUT')}}
                                                <input type="hidden" name="post_id" value="{{$content->post_id}}">
                                                <input type="hidden" name="tab_id" value="{{$content->tab_id}}">
                                                <input type="hidden" name="tab_type" value="{{$content->tab_type}}">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" class="form-control" value="{{$content->title}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Code</label>
                                                    <textarea name="snippet" id="snippet" rows="5" class="form-control">{{json_decode($content->snippet)}}</textarea>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    @endforeach
                                </table>
                            @endif
                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">{{date('Y')}} © <b>{{env('APP_NAME')}}</b> - All rights reserved.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>
<div class="modal" tabindex="-1" role="dialog" id="postTabModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Post Tab Manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('postTabManager.save')}}" method="post">
      <div class="modal-body">
            {!! csrf_field() !!}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="tab_type" id="tab_type">
            <div class="form-group">
                <select name="tab_id" id="selectedTab" class="form-control">
                    <option value="">Select Tab</option>
                    @foreach($tabs as $tab)
                    <option value="{{$tab->id}}">{{$tab->title}}</option>
                    @endforeach
                </select>
            </div>
            <div id="postTabTableSection" style="display:none;">
                <div class="form-group">
                    <label>Parameter</label>
                    <input type="text" name="parameter" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div id="postTabSnippetSection" style="display:none;">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Code</label>
                    <textarea name="snippet" id="snippet" rows="5" class="form-control"></textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<style>
  pre{
    overflow: auto;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script>
    function openPostTabModel()
    {
        $('#postTabModel').modal('show');
    }
    var token = $('input[name=\'_token\']').val();
    $(document).ready(function(){
       $('#selectedTab').change(function(){
            var id = $(this).val();
            $.ajax({
            type: "GET",
            url: "{{route('postTab.ajaxTab')}}",
            data: "_token="+token+"&id="+id,
            cache: false,
            success: function(data){
              console.log(data)
              $('#tab_type').val(data)
              if(data == 'table')
              {
                $('#postTabTableSection').show();
              }else{
                $('#postTabTableSection').hide();
              }
              if(data == 'snippet')
              {
                $('#postTabSnippetSection').show();
              }else{
                $('#postTabSnippetSection').hide();
              }
            },
            error: function(error){
              alert('failed')
            }
        });
        }) 
    })

    function openPostTabTableTypeModel(id)
    {
        $('#postTabEditModel'+id).modal('show');
    }
    function openPostTabCodeTypeModel(id)
    {
        $('#postTabEditModel'+id).modal('show');
    }

        // $('a[data-toggle="tab"]').click(function (e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });

        // $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
        //     var id = $(e.target).attr("href");
        //     localStorage.setItem('selectedTab', id)
        // });

        // var selectedTab = localStorage.getItem('selectedTab');
        // if (selectedTab != null) {
        //     $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
        // }
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
          $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
</script>
<script>
  $(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    // alert(e.target);
		sessionStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = sessionStorage.getItem('activeTab');
	if(activeTab){
    // alert('yes');
		$('#myTab a[href="' + activeTab + '"]').tab('show');
  }
  else{
    // alert('no');

    $('#myTab a:first').tab('show');
  }
});
</script>
@endsection