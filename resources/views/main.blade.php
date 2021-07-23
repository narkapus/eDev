@extends('layouts.app', ['activePage' => 'main', 'titlePage' => __('รายการเอกสาร')])

@section('content')

<!-- <script src="{{ asset('material') }}/js/plugins/jquery-2.2.4.min.js"></script>  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<?php
$date = Carbon\Carbon::now();
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary" style="background: #B6EEBD;padding-bottom: 0px;">
            <h4 class="card-title" style="color:#0F0E0F">รายการล่าสุด</h4>
            <div class="row">
                <p class="card-category col-sm-8" style="color:#0F0E0F;margin-top:10px">วันที่ <?php echo date("d/m/Y", strtotime($date)); ?></p>
                <div class="form-group text-right col-sm-4">
                    <!-- <label for="upload_file" class="control-label col-sm-4">
                    <a><img src="{{ asset('material') }}/img/upload.png" alt="logo"/></a></label>
                    <div class="col-sm-12">
                         <input class="form-control" type="file" name="upload_file" id="upload_file">
                    </div> -->
                    <div class="">
                        <button id="addDocument" class="btn btn-success" onclick="addDocument()">
                            เพิ่มเอกสาร
                        </button>
                    </div>
               </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-striped table-hover table-condensed" style="text-align: center;width:100%">
                <thead>
                  <tr>
                    <td style="width:10%">ลำดับ</td>
                    <td style="width:25%">ประเภทเอกสาร</td>
                    <td style="width:25%">เจ้าของเอกสาร</td>
                    <td style="width:15%">เอกสาร</td>
                    <td style="width:10%">บันทึกวันที่</td>
                    <td style="width:10%">แก้ไขวันที่</td>
                  </tr>
                </thead>
                <tbody>

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
            <form  class="form-submit" id="addFormDoc" method="post"  action="{{ url('/home/save') }}" enctype="multipart/form-data">
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
$(function () {
  var table = $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
        ajax: "{{ route('home') }}",
        columns: [
            {data: 'eCode', name: 'eCode'},
            {data: 'eName', name: 'eName'},
            { "data": "eFile", "name": "eFile",
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    // if(oData.client_name) {
                    $(nTd).html("<a href='"+sData+"'>"+sData+"</a>");
                    // }
                }
            },
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
            {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
        ]
  });
  
});
</script>
@endsection
