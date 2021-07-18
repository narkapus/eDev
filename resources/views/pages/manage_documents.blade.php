@extends('layouts.app', ['activePage' => 'manage_documents', 'titlePage' => __('จัดการเอกสาร')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="/manage" method="POST" role="search">
                {{ csrf_field() }}
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
                          <th>{{$data->createDate}}</th>
                          <th>{{$data->update_Date}}</th>
                          <th style="text-align: center">{{$data->name}}</th>
                        </tr>
                    @endforeach
                    </table>
                  </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
