<?php

namespace App\Http\Controllers;
use App\Models\Members;
use Illuminate\Http\Request;
use DataTables;
use Redirect,Response;
use Exception;
use Illuminate\Support\Facades\Validator;

class CreateUsersController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Members::get();
        //    echo "<pre>"; print_r($data);die; echo "</pre>";
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
            $action = '
            <i class="material-icons"><a id="edit-off" data-toggle="modal" data-id='.$row->mb_no.'>edit</a></i>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <i class="material-icons"><a id="delete-off" data-id='.$row->mb_no.'>delete</a></i>';
            return $action;
            })->rawColumns(['action'])->make(true);
         }
            return view('pages.create_users');
    }

    public function store(Request $request)
    {
        $rule = [
            'mb_no' => 'required',
            'mb_name' => 'required',
        ];
        $message = [
            'mb_no.required' => 'Please enter member no.',
            'mb_name.required' => 'Please enter member name.',
        ];
        try {
            $validator = Validator::make($request->all(), $rule, $message);

            if ($validator->fails())
            {
                return responseJson(400, $validator->errors()->first());
                //return response()->json(['errors'=>$validator->errors()->all()]);
            }
                $uId = $request->mb_no;
                Members::updateOrCreate(['mb_no' => $uId],['mb_name' =>$request->mb_name]);
            if(empty($request->id))
                $msg = 'created successfully.';
            else
                $msg = 'Data is updated successfully';
            return redirect()->route('create_users.index')->with('success',$msg);

        }
        catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function edit($id)
    {
        $where = array('mb_no' => $id);
        $off = Members::where($where)->first();
        return Response::json($off);
    }

    public function destroy($id)
    {
        $off = Members::where('mb_no',$id)->delete();
        return Response::json($off);
    }
}
