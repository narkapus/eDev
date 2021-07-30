@extends('layouts.app',['activePage' => '', 'titlePage' => ''])
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!DOCTYPE html>
<html lang="en" class="h-85">
<body class="h-100">
    <div class="authincation h-100">
        <div class="authincation h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-7">
                        <div class="form-input-content text-center error-page">
                            <h1 class="error-text font-weight-bold" style="text-align: center">{{ $error['statusCode'] }}</h1>
                            <h4 class="mt-2" style="text-align: center"><i class="fa fa-times-circle text-danger"></i> {{ $error['messageEN'] }}</h4>
                            <h3 style="text-align: center">{{ $error['messageTH'] }}</h3>
                            <div class="mt-5" style="text-align: center">
                                <a href="{{ url('../home') }}"><u class="font-w500 fs-18">กลับสู่หน้าหลัก</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@endsection
