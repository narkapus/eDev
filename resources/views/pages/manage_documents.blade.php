@extends('layouts.app', ['activePage' => 'manage_documents', 'titlePage' => __('จัดการเอกสาร')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="/manage" method="POST" role="search">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th style="text-align: center; font-weight:bold;">
                          รหัสเอกสาร
                        </th>
                        <th style="font-weight:bold;">
                          ชื่อเอกสาร
                        </th>
                        <th style="font-weight:bold;">
                          วันที่สร้างเอกสาร
                        </th>
                        <th style="font-weight:bold;">
                          วันที่แก้ไขล่าสุด
                        </th>
                        <th style="text-align: center; font-weight:bold;">
                          ผู้อัพโหลด
                        </th>
                      </thead>
                        @foreach($items as $key => $data)
                        <tr>
                          <th style="text-align: center">{{$data->eCode}}</th>
                          <th>{{$data->eName}}</th>
                          <th>{{$data->created_at}}</th>
                          <th>{{$data->updated_at}}</th>
                          <th style="text-align: center">{{$data->name}}</th>
                          <th><a value ="{{ $data->eCode }}" onclick="editData('{{ $data->eCode }}')"><i class="material-icons">edit</i><a></th>
                        </tr>
                    @endforeach
                    </table>
                        <div class="col-md-3">
                            <button type="button" id="add" class="btn btn-default" onclick="addData()">
                                เพิ่มเอกสาร
                            </button>
                        </div>
                  </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form  class="form-submit" id="addForm" method="post"  action="{{ url('/manage/postSave') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มประเภทเอกสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>รหัสเอกสาร</label>
                        <input type="text" name="eCode" id="eCode" value="" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>ประเภทเอกสาร</label>
                        <input type="text" name="eName" id="eName" value="" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="action" value="Add" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form  class="form-submit" id="addForm2" method="get"  action="{{ url('/manage/postEdit/'.$data->eCode) }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขประเภทเอกสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($geteDoc as $key => $data)
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>รหัสเอกสาร</label>
                        <input type="text" name="eCode" id="eCode" value="{{ $data->eCode }}" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>ประเภทเอกสาร</label>
                        <input type="text" name="eName" id="eName" value="{{ $data->eName }}" class="form-control" />
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="action2" value="addEdit" class="btn btn-primary">แก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
function addData(){
    $('#addModal').modal('show');
    $('#addForm')[0].reset();
    $('#action').val('Add');
}

function editData(eCode){
    alert(eCode);
    $('#addModal2').modal('show');
    $('#addForm2')[0].reset();
    $('#action2').val('addEdit');
}
</script>
