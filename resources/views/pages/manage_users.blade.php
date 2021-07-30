@extends('layouts.app', ['activePage' => 'manage_users', 'titlePage' => __('จัดการผู้ใช้งาน')])

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
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="text" name="password" id="password" class="form-control" placeholder="password" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>สิทธ์การใช้งาน:</strong>
                                {{-- <input type="text" name="role" id="role" class="form-control" placeholder="role" onchange="validate()" > --}}
                                <select class="form-control" name="role" id="role">
                                    <option value='' disabled selected>กรุณาเลือก</option>
                                    <option value='0'>ผู้ใช้งานทั่วไป</option>
                                    <option value='1'>ผู้ดูแลระบบ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()">
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
