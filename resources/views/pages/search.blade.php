@extends('layouts.app', ['activePage' => 'search', 'titlePage' => __('ค้นหาเอกสาร')])

@section('content')
<script src="{{ asset('material') }}/js/plugins/jquery-2.2.4.min.js"></script> 
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="">
            <button id="addDocument" class="btn btn-success" onclick="addDocument()">
                เพิ่มเอกสาร
            </button>
        </div>
        <div class="card">
          <div class="card-body">
            <form class="form-submit" method="GET"  action="{{ url('/search') }}">
                <div class="row">
                    <div class="col-md-6">
                        <label>ประเภทเอกสาร</label>
                        <select class="form-control" name="search">
                            @if(!empty($items))
                            <option value="" disabled selected>เลือกประเภทเอกสาร</option>
                            @foreach ($items as $key => $value)
                                <option value="{{ $key+1 }}" {{ ( $key+1 ) ? 'เลือกข้อมูล' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 1%">
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="เลขที่สมาชิก" name="userId">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="ชื่อ-นามสกุล"  name="fullName">
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-default">
                                ค้นหา
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed" style="text-align: center;">
                    <tbody>
                        <thead>
                            <tr>
                                <th>รหัสเอกสาร</th>
                                <th>ชื่อเอกสาร</th>
                                <th>ผู้อัพโหลด</th>
                                <th>วันที่อัพโหลด</th>
                            </tr>
                        </thead>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item->eCode }}</td>
                                <td>{{ $item->eName }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ date("d/m/Y H:m:s", strtotime($item->created_at)); }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalAddDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form  class="form-submit" id="addFormDoc" method="post"  action="{{ url('/search/save') }}" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มเอกสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>ประเภทเอกสาร</label>
                        <select class="form-control" name="eCode" id="eCode">
                            @if(!empty($items))
                            <option value="" disabled selected>เลือกประเภทเอกสาร</option>
                            @foreach ($items as $key => $value)
                                <option value="{{ $key+1 }}" {{ ( $key+1 ) ? 'เลือกข้อมูล' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ประเภทเอกสาร</label>
                        <div class="col-md-6">
                            <input class="form-control" id="filename" name='filename' type="text" style="readonly:true;">
                        </div>
                        <div class="col-md-4">
                            <label for="eFile" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Upload file
                            </label>
                            <input id="eFile" name='eFile' class="file" type="file" style="display:none;" multiple data-preview-file-type="any" data-upload-url="#">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="action" value="Add" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
var table = document.getElementById('addDocument');
function addDocument(){
    $('#modalAddDocument').modal('show');
        $('#addFormDoc')[0].reset();
        $('#action').val('Add');
}
$('#eFile').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#eFile')[0].files[0].name;
  $("#filename").val(file);
});
</script>
@endsection