@extends('layouts.app', ['activePage' => 'main', 'titlePage' => __('รายการเอกสาร')])

@section('content')

    <link href="{{ asset('material') }}/css/dataTables/buttons.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('material') }}/css/dataTables/jquery.dataTables.min.css" rel="stylesheet">
    <script src="{{ asset('material') }}/js/core/jquery-3.5.1.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/dataTables.buttons.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jszip.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/pdfmake.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/vfs_fonts.js"></script>
    <script src="{{ asset('material') }}/js/plugins/buttons.html5.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/bootstrap3-typeahead.js"></script>

    <style>
        .custom-file-upload{
            padding-top : 30px;clear: both;
        }
        .custom-file-upload-text{
            background-color: transparent !important;clear: both;
        }
        .container {
            max-width: 600px;
        }
        .txtLabel{
            top:-30px !important;
        }
        .txtInput{
            margin-top:20px;
        }
    </style>
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
                        <td style="width:30%">ประเภทเอกสาร</td>
                        <td style="width:15%">เอกสาร</td>
                        <td style="width:15%">ผู้บันทึก</td>
                        <td style="width:10%">บันทึกวันที่</td>
                        <td style="width:10%">แก้ไขวันที่</td>
                        <td style="width:7%">ดาวน์โหลด</td>
                        {{-- <td style="width:10%">Action</td> --}}
                  </tr>
                </thead>
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
            <form  class="form-submit" id="addFormDoc" method="post"  action="{{ route('home.store') }}" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="docModal"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>ประเภทเอกสาร</label>
                        <div class="col-md-10">
                            {!! Form::select('eCode', $items, null, ['class' => 'form-control inputDoc', "id"=>"eCode",'placeholder' => 'เลือกประเภทเอกสาร']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="txtLabel">ทะเบียนสมาชิก</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control inputDoc txtInput" id="eMember" name="eMember" placeholder="Search" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>เอกสาร</label>
                        <div class="col-md-6">
                            <input class="form-control" id="actionDoc" name='actionDoc' type="text" hidden>
                            <input class="form-control" id="idDoc" name='idDoc' type="text" hidden>
                        </div>
                        <div class="col-md-8">
                            <label for="eName" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Upload file
                                <input id="eName" name='eName' class="file inputDoc" type="file" style="display: none;" multiple data-preview-file-type="any" data-upload-url="#" accept="application/pdf , image/gif, image/jpeg, image/jpg, image/png, image/bmp">
                                <input class="form-control custom-file-upload-text" id="filename" name='filename' type="text" readOnly>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="actionSave" name="btnsave" class="btn btn-primary actionSave"></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
var role = "{{ Auth::user()->role }} ";
$(document).ready(function () {
    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('home') }}",
        columns: [
            {data: "DT_RowIndex" },
            {data: 'mdName', name: 'mdName'},
            {data: 'download', name: 'download'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at',
                "render": function (data) {
                    var datePart = data.match(/\d+/g),
                        year = datePart[0], // get only two digits
                        month = datePart[1],
                        day = datePart[2];
                    var time = data.split(" ");
                    return day+'/'+month+'/'+year+' '+time[1];
                }
            },
            {data: 'updated_at', name: 'updated_at',
                "render": function (data) {
                    var datePart = data.match(/\d+/g),
                        year = datePart[0], // get only two digits
                        month = datePart[1],
                        day = datePart[2];
                    var time = data.split(" ");
                    return day+'/'+month+'/'+year+' '+time[1];
                }
            },
            {data: 'eFile', name: 'eFile',
                "render": function (data) {
                    if(role == 1) {
                        return data;
                    } else {
                        return 'ไม่มีสิทธ์ดาวน์โหลด';
                    }
                }
            },
            // {data: 'action', name: 'action'},
        ],
    });
    $("#actionSave").attr("disabled", true);
    $('#eName').change(function() {
        var i = $(this).prev('label').clone();
        var file = $('#eName')[0].files[0].name;
        $("#filename").val(file);
    });

    /* action save/update data */
    $('.inputDoc').on('change',function() {
        var docCode = $('#eCode').val();
        var file = $('#eName').val();
        var member = $('#eMember').val();
        var bt_action = $('#actionDoc').val();
        if((docCode !='' && file !='' && member != '' && bt_action == 'save') || bt_action == 'update')
            $("#actionSave").removeAttr("disabled");
        else
            $("#actionSave").attr("disabled", true);
    });


    /* Edit Doc */
    $('body').on('click', '#edit-file', function () {
    var doc_id = $(this).data("id");
    $.get("/home/" +doc_id+ "/edit", function (data) {
        console.log(data.eCode);
        $('#addFormDoc')[0].reset();
        $('#docModal').html("แก้ไขเอกสาร");
        $('#modalAddDocument').modal('show');
        $('#actionSave').text("Update");
        $('#actionDoc').val('update');
        $('#idDoc').val(doc_id);
        $('#eCode').val(data.eCode);
        $("#filename").val(data.eName);
        $("#eName").text(data.eFile);
        })
    });

    /* Delete Doc */
    $('body').on('click', '#delete-file', function () {
        var doc_id = $(this).data("id");
        $('#idDoc').val(doc_id);
        var token = $("meta[name='csrf-token']").attr("content");
        if(confirm("ยืนยันลบข้อมูล!")) {
            $.ajax({
                type: "DELETE",
            url: "../home/delete/"+doc_id,
            data: {
                "id": doc_id,
                "_token": token,
            },
            success: function (data) {
                table.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
            });
        }
        else{
            return false;
        };
    });
});
function addDocument(){
    $('#modalAddDocument').modal('show');
    $('#addFormDoc')[0].reset();
    $('#docModal').html("เพิ่มเอกสาร");
    $('#actionSave').text('Save');
    $('#actionDoc').val('save');
}
$('#eMember').typeahead({
    source: function (query, process) {
        return $.get("{{ url('home/autocomplete-search') }}", {
            query: query
        }, function (data) {
            return process(data);
        });
    }
});
</script>
@endsection
