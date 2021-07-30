<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Redirect,Response;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Validator;

class ManageUsersController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
            $action = '
            <i class="material-icons"><a id="edit-user" data-toggle="modal" data-id='.$row->id.'>edit</a></i>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <i class="material-icons"><a id="delete-user" data-id='.$row->id.'>delete</a></i>';
            return $action;
            })->rawColumns(['action'])->make(true);
        }
            return view('pages.manage_users');
    }

    public function store(Request $request)
    {
        $rule = [
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required',
            'role' => 'required',
        ];
        $message = [
            'name.required' => 'Please enter name.',
            'password.required' => 'Please enter password.',
            'email.required' => 'Please enter email.',
            'role.required' => 'Please enter role.',
        ];
        try {
            $validator = Validator::make($request->all(), $rule, $message);
            if ($validator->fails()) {
                return responseJson(400, $validator->errors()->first());
            }
                $uId = $request->user_id;
                User::updateOrCreate(['id' => $uId],['name' => $request->name, 'password' => Hash::make($request->password), 'role' => $request->role, 'email' => $request->email]);
            if(empty($request->user_id))
                $msg = 'User created successfully.';
            else
                $msg = 'User data is updated successfully';
            return redirect()->route('manage_users.index')->with('success',$msg);

        }   catch (Exception $ex) {
            return abort(500, $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user = User::where($where)->first();
        return Response::json($user);
    }

    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
        return Response::json($user);
    }
}
