@extends('layouts.app', ['activePage' => 'search', 'titlePage' => __('ค้นหาเอกสาร')])

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
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            {{ Form::open(array('url' => '/search', 'method' => 'get')) }}
                <div class="row">
                    <div class="col-md-6">
                        <label>ประเภทเอกสาร</label>
                        {!! Form::select('docCode', $items, null, ['class' => 'form-control','placeholder' => 'ประเภทเอกสารทั้งหมด', 'id'=>'docCode']) !!}
                    </div>
                </div>
                <div class="row" style="margin-top: 1%">
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="เลขที่สมาชิก" name="userId">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="ชื่อ-นามสกุล"  name="fullName">
                    </div>
                </div>
                <div class="row" style="margin-top: 1%">
                    <div class="col-md-2">
                        <label class="label-control">วันที่อัพโหลด</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date"  name="date_from" data-date="" id="date_from" class="form-control"/>
                    </div>
                    <div>
                        <label class="label-control">ถึง</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date"  name="date_to" data-date="" id="date_to" class="form-control"/>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-default">
                                ค้นหา
                            </button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
            <div class="table-responsive">
                <table id="dataTable-search" class="table table-striped table-hover table-condensed" style="text-align: center;width:100%">
                    <tbody>
                        <thead>
                            <tr>
                                <th>รหัสเอกสาร</th>
                                <th>ประเภทเอกสาร</th>
                                <th>ชื่อเอกสาร</th>
                                <th>ผู้อัพโหลด</th>
                                <th>วันที่อัพโหลด</th>
                                <th>ดาวน์โหลด</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var role = "{{ Auth::user()->role }} ";
$(document).ready(function () {
    var table = $('#dataTable-search').DataTable({
        processing: true,
        serverSide: true,
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
            {data: 'eFile', name: 'eFile',
                "render": function (data) {
                    if(role == 1) {
                        return data;
                    } else {
                        return 'ไม่มีสิทธ์ดาวน์โหลด';
                    }
                }
            },
        ],
    });
});
</script>
@endsection
