<?php

namespace App\Http\Controllers;
// use Storage;
use App\Models\MasterDocuments;
use App\Models\Documents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Response;
use Exception;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $code = $request->input('docCode');
        $userId = $request->input('userId');
        $fullName = $request->input('fullName');
        $conditons = "";

        $items = MasterDocuments::pluck('eName','id');
        $user = User::pluck('name');

        // $post = DB::table('documents')->select('md.eCode as mdCode','md.eName as mdName','documents.eName','documents.created_at')
        //         ->join('users','users.id','=','documents.userId')
        //         ->join('master_documents as md','md.id','=','documents.eCode')
        //         ->orderBy('documents.created_at','desc');
        if($code){
            $conditons .= " and doc.eCode = ".$code;
        }
        if($userId){
            $conditons .= " and users.Id = ".$userId;
        }
        if($fullName){
            $conditons .= " and name like '%".$fullName."%'";
        }
        // $post = $post->get();
        $post = DB::select("select doc.id,doc.eCode,md.eName AS mdName,doc.eName,eFile,name,doc.created_at,doc.updated_at
                            from documents doc
                            join users on users.id = doc.userId
                            join master_documents as md on md.id = doc.eCode
                            where doc.eStatus = 1 $conditons
                            order by doc.created_at desc");

        // print_r($post);die;
        if($request->ajax()){
            return Datatables::of($post)
                ->addIndexColumn()
                ->addColumn('eFile', function($row){
                    $eFile = '<a href="home/preview/'.$row->id.'"  target="_blank">'.$row->eName.'</a>';
                    return $eFile;
                })
                ->addColumn('action', function($row){
                    $action = '
                    <i class="material-icons"><a id="edit-file" data-toggle="modal" data-id='.$row->id.'>edit</a></i>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <i class="material-icons"><a id="delete-file" data-id='.$row->id.'>delete</a></i>';
                    return $action;
                })
                ->rawColumns(['eFile','action'])
                ->make(true);
        }
        return view('pages.search',compact('items','user','post'));
    }
}
