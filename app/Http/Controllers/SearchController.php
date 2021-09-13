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
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
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
            $conditons .= " and m.mb_no like '%".$userId."%'";
        }
        if($fullName){
            $conditons .= " and mb_name like '%".$fullName."%'";
        }
        if($date_from && $date_to){
            $conditons .= " and date(doc.created_at) between '".$date_from."' and '".$date_to."'";
        }else if ($date_from){
            $conditons .= " and date(doc.created_at) = '".$date_from."'";
        }
        // $post = $post->get();
        $post = DB::select("select doc.id,doc.eCode,md.eName AS mdName,doc.eName,eFile,name,doc.created_at,doc.updated_at,doc.eMember,mb_name
                            from documents doc
                            join users on users.id = doc.userId
                            join master_documents as md on md.id = doc.eCode
                            join edocuments.members as m on m.mb_no = doc.eMember
                            where doc.eStatus = 1 $conditons
                            order by doc.created_at desc");

        // print_r($post);die;
        if($request->ajax()){
            return Datatables::of($post)
                ->addIndexColumn()
                ->addColumn('eFile', function($row){
                    $eFile = '<a href="home/preview/'.$row->id.'"  target="_blank"><i class="material-icons" style="color: gray;">'.'download'.'</i></a>';
                    return $eFile;
                })
                ->addColumn('action', function($row){
                    $action = '
                    <i class="material-icons"><a id="edit-file" data-toggle="modal" data-id='.$row->id.'>edit</a></i>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <i class="material-icons"><a id="delete-file" data-id='.$row->id.'>delete</a></i>';
                    return $action;
                })
                ->addColumn('download', function($row){
                    $showName = $row->eName;
                    return $showName;
                })
                ->rawColumns(['eFile','action'])
                ->make(true);
        }
        return view('pages.search',compact('items','user','post'));
    }
}
