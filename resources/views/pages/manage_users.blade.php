@extends('layouts.app', ['activePage' => 'manage_users', 'titlePage' => __('จัดการผู้ใช้งาน')])

@section('content')

<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('material') }}/css/dataTables/buttons.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('material') }}/css/dataTables/jquery.dataTables.min.css" rel="stylesheet">
<script src="{{ asset('material') }}/js/core/jquery-3.5.1.js"></script>
<script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/dataTables.buttons.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/jszip.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/pdfmake.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/vfs_fonts.js"></script>
<script src="{{ asset('material') }}/js/plugins/buttons.html5.min.js"></script>
<script>
error=false

function validate()
{
if(document.userForm.name.value !='' && document.userForm.email.value !='' )
document.userForm.btnsave.disabled=false
else
document.userForm.btnsave.disabled=true
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
                            <a class="btn btn-success mb-2" id="new-user" data-toggle="modal">เพิ่มรหัสผู้ใช้งาน</a>
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
                          <td style="width:25%">รหัสผู้ใช้งาน</td>
                          <td style="width:20%">ชื่อ-นามสกุล</td>
                          <td style="width:25%">Email</td>
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
<!-- Add and Edit User modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="userForm" action="{{ route('manage_users.store') }}" method="POST">
                    <input type="hidden" name="user_id" id="user_id" >
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อ-นามสกุล:</strong>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="text" name="password" id="password" class="form-control" placeholder="password" onchange="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>สิทธ์การใช้งาน:</strong>
                                <select class="form-control" name="role" id="role" required>
                                    <option value='' disabled selected>กรุณาเลือก</option>
                                    <option value='0'>ผู้ใช้งานทั่วไป</option>
                                    <option value='1'>ผู้ดูแลระบบ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Save</button>
                            <a href="{{ route('manage_users.index') }}" class="btn btn-danger">Cancel</a>
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
    ajax: "{{ route('manage_users.index') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

/* When click New User button */
$('#new-user').click(function () {
    $('#btn-save').val("create-user");
    $('#user').trigger("reset");
    $('#userCrudModal').html("เพิ่มรหัสผู้ใช้งาน");
    $('#crud-modal').modal('show');
});

/* Edit User */
$('body').on('click', '#edit-user', function () {
var user_id = $(this).data('id');
$.get("/manage_users/" +user_id+ "/edit", function (data) {
    $('#userCrudModal').html("Edit User");
    $('#btn-update').val("Update");
    $('#btn-save').prop('disabled',false);
    $('#crud-modal').modal('show');
    $('#user_id').val(data.id);
    $('#name').val(data.name);
    $('#password').val(data.password);
    $('#role').val(data.role);
    $('#email').val(data.email);
    })
});

/* Delete User */
$('body').on('click', '#delete-user', function () {
    var user_id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
        if(confirm("ยืนยันลบข้อมูล!")) {
            $.ajax({
            type: "DELETE",
            url: "../manage_users/"+user_id,
            data: {
            "id": user_id,
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
