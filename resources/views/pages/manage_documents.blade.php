@extends('layouts.app', ['activePage' => 'manage_documents', 'titlePage' => __('จัดการเอกสาร')])

@section('content')

<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
error=false

function validate()
{
if(document.docForm.eCode.value !='' && document.docForm.eName.value !='' )
document.docForm.dibtnsavesabled=false
else
document.docForm.btnsave.disabled=true
}
</script>
</head>
<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary" style="background: #B6EEBD;padding-bottom: 0px;">
                            <div class="row">
                                <p class="card-category col-sm-8"></p>
                                <div class="form-group text-right col-sm-4">
                                    <div class="pull-right">
                                        <a class="btn btn-success mb-2" id="new-doc" data-toggle="modal">เพิ่มเอกสาร</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed data-table" style="text-align: center;width:100%">
                                    <thead>
                                        <tr>
                                        <td style="width:10%">ลำดับ</td>
                                        <td style="width:10%">รหัสเอกสาร</td>
                                        <td style="width:40%">ชื่อเอกสาร</td>
                                        <td style="width:15%">วันที่สร้างเอกสาร</td>
                                        <td style="width:15%">วันที่แก้ไขล่าสุด</td>
                                        <td style="width:10%">Action</td>
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
    <div class="modal fade" id="crud-modal" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="docCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form name="docForm" action="{{ route('manage.store') }}" method="POST">
                        <input type="hidden" name="doc_id" id="doc_id" >
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>รหัสเอกสาร:</strong>
                                    <input type="text" name="eCode" id="eCode" class="form-control" placeholder="รหัสเอกสาร" value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>ประเภทเอกสาร:</strong>
                                    <input type="text" name="eName" id="eName" class="form-control" placeholder="ประเภทเอกสาร">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Save</button>
                                <a href="{{ route('manage.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('manage.index') }}",
        columns: [
            { "data": "DT_RowIndex" },
            { "data": "eCode" },
            { "data": "eName" },
            {
                "data": "created_at",
                "render": function (data) {
                var datePart = data.match(/\d+/g),
                    year = datePart[0], // get only two digits
                    month = datePart[1],
                    day = datePart[2];
                    return day+'/'+month+'/'+year;
                    }
                },
                {
                "data": "updated_at",
                "render": function (data) {
                var datePart = data.match(/\d+/g),
                    year = datePart[0], // get only two digits
                    month = datePart[1],
                    day = datePart[2];
                    return day+'/'+month+'/'+year;
                    }
                },
            { "data": "action" , orderable: false, searchable: false},
        ]
    });
    /* When click New Doc button */
    $('#new-doc').click(function () {
        $('#btn-save').val("create-doc");
        $('#doc').trigger("reset");
        $('#docCrudModal').html("เพิ่มประเภทเอกสาร");
        $('#crud-modal').modal('show');
    });

    /* Edit Doc */
    $('body').on('click', '#edit-doc', function () {
    var doc_id = $(this).data("id");
    $.get("/manage/" +doc_id+ "/edit", function (data) {
        $('#docCrudModal').html("แก้ไขรายละเอียดเอกสาร");
        $('#btn-update').val("Update");
        $('#btn-save').prop('disabled',false);
        $('#crud-modal').modal('show');
        $('#eCode').val(data.eCode);
        $('#eName').val(data.eName);
        })
    });

    /* Delete Doc */
    $('body').on('click', '#delete-doc', function () {
        var doc_id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
            if(confirm("ยืนยันลบข้อมูล!")) {
                $.ajax({
                type: "DELETE",
                url: "../manage/"+doc_id,
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
            else
            {
                return false;
            };
        });
    });

    </script>
    @endsection


