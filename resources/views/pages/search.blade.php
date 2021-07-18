@extends('layouts.app', ['activePage' => 'search', 'titlePage' => __('ค้นหาเอกสาร')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
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
                                <td>{{ $item->userId }}</td>
                                <td>{{ $item->createDate }}</td>
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
@endsection

