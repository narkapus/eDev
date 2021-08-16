<?php

namespace App\Http\Controllers;
use App\Models\MasterDocuments;
use Illuminate\Http\Request;
use DataTables;
use Redirect,Response;
use Exception;
use Illuminate\Support\Facades\Validator;

class ManageDocumentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterDocuments::latest()->get();

        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
            $action = '
            <i class="material-icons"><a id="edit-doc" data-toggle="modal" data-id='.$row->eCode.'>edit</a></i>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <i class="material-icons"><a id="delete-doc" data-id='.$row->eCode.'>delete</a></i>';
            return $action;
            })->rawColumns(['action'])->make(true);
        }
            return view('pages.manage_documents');
    }

    public function store(Request $request)
    {
        $rule = [
            'eCode' => 'required',
            'eName' => 'required',
        ];
        $message = [
            'eCode.required' => 'Please enter eCode.',
            'eName.required' => 'Please enter eName.',
        ];
        try {
            $validator = Validator::make($request->all(), $rule, $message);

            if ($validator->fails())
            {
                return responseJson(400, $validator->errors()->first());
                //return response()->json(['errors'=>$validator->errors()->all()]);
            }
                $uId = $request->eCode;
                MasterDocuments::updateOrCreate(['eCode' => $uId],['eName' =>$request->eName]);
            if(empty($request->id))
                $msg = 'created successfully.';
            else
                $msg = 'Data is updated successfully';
            return redirect()->route('manage.index')->with('success',$msg);

        }   catch (Exception $ex) {
            return abort(500, $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $where = array('eCode' => $id);
        $doc = MasterDocuments::where($where)->first();
        return Response::json($doc);
    }

    public function destroy($id)
    {
        $doc = MasterDocuments::where('eCode',$id)->delete();
        return Response::json($doc);
    }
}
