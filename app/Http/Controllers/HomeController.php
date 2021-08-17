<?php

namespace App\Http\Controllers;
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

class HomeController extends Controller
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
        $items = MasterDocuments::pluck('eName','id');
        $user = User::pluck('name');
        $post = DB::select("select doc.id,doc.eCode,md.eName AS mdName,doc.eName,eFile,name,doc.created_at,doc.updated_at
                            from documents doc
                            join users on users.id = doc.userId
                            join master_documents as md on md.id = doc.eCode
                            where  doc.eStatus = 1 and userId = ".auth()->id()."
                            order by doc.created_at desc");
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
        return view('main',compact('items','user','post'));
    }

    public function create(Request $request)
    {

        $uploadedFile = $request->file('eFile');
        $fileName = time()."/".$uploadedFile->getClientOriginalName();
        $filePath = $request->file('eFile')->storeAs('uploads', $fileName, 'public');
        $mDocument = new Documents();
        // print_r($request->input('eCode'));exit;
        $mDocument->eCode = $request->input('eCode');
        $mDocument->eName = $uploadedFile->getClientOriginalName();
        // $mDocument->eFile = $filename;
        $mDocument->eFile = '/storage/' . $filePath;
        $mDocument->userId = auth()->id();
        $mDocument->save();
        return redirect()->route("home")->with('message','Success');
    }
    public function store(Request $request)
    {
        $rule = [
            'eCode' => 'required',
            'filename' => 'required',
        ];
        $message = [
            'eCode.required' => 'Please enter eCode.',
            'filename.required' => 'Please select eFile.',
        ];
        try {
            $validator = Validator::make($request->all(), $rule, $message);
            if ($validator->fails()) {
                print_r($validator->errors()->first());die;
                return responseJson(400, $validator->errors()->first());
            }
            if($request->input('actionDoc') == 'save'){
                $uId = $request->eCode;
                $uploadedFile = $request->file('eName');
                $fileName = $uId."/".$uploadedFile->getClientOriginalName();
                $filePath = $request->file('eName')->storeAs('uploads', $fileName, 'public');
                $mDocument = new Documents();
                $mDocument->eCode = $request->input('eCode');
                $mDocument->eName = $uploadedFile->getClientOriginalName();
                $mDocument->eFile = 'app/public/' . $filePath;
                $mDocument->userId = auth()->id();
                $mDocument->save();
            }elseif($request->input('actionDoc') == 'update') {
                $where = array('id' => $request->idDoc);
                $mDocument = Documents::where($where)->first();
                // print_r($mDocument->eName);die;
                $mDocument->eCode = $request->input('eCode');
                if($request->filename != $mDocument->eName){
                    $uploadedFile = $request->file('eName');
                    $fileName = $uId."/".$uploadedFile->getClientOriginalName();
                    $filePath = $request->file('eName')->storeAs('uploads', $fileName, 'public');
                    $mDocument->eName = $uploadedFile->getClientOriginalName();
                    $mDocument->eFile = 'app/public/' . $filePath;
                }
                $mDocument->userId = auth()->id();
                $mDocument->save();
            }elseif($request->input('actionDoc') == 'delete'){
                $where = array('id' => $request->idDoc);
                $mDocument->userId = auth()->id();
                $mDocument->eStatus = 0;
                $mDocument->save();
            }
            if(empty($request->id))
                $msg = 'created successfully.';
            else
                $msg = 'Data is updated successfully';
            return redirect()->route('home')->with('success',$msg);

        }   catch (Exception $ex) {
            return abort(500, $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $doc = Documents::where($where)->first();
        return Response::json($doc);
    }

    public function destroy($id)
    {
        $doc = Documents::where('id',$id)->delete();
        return Response::json($doc);
    }

    public function preview(Request $request){
        $where = array('id' => $request->id);
        $doc = Documents::where($where)->first();
        $path = storage_path(str_replace("/","\\",$doc->eFile));
        $filename = $doc->eName;
        $extensionFile = explode('.',strtolower($filename));
        $extensionFile = $extensionFile[1];
        if($extensionFile == 'pdf')
            $contentType = 'application';
        else
            $contentType = 'image';
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => $contentType.'/'.$extensionFile,
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]) ;
    }
}
