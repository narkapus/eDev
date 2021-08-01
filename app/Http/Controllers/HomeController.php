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
        $items = MasterDocuments::pluck('eName');
        $user = User::pluck('name');
        $post = DB::select('select doc.id,doc.eCode,md.eName AS mdName,doc.eName,eFile,name,doc.created_at,doc.updated_at
                            from documents doc
                            join users on users.id = doc.userId
                            join master_documents as md on md.eCode = doc.eCode
                            where date(doc.created_at) = CURDATE() AND doc.eStatus = 1');
        // DB::table('documents')->select('eCode','eName','name','documents.created_at')
        //     ->join('users','users.id','=','documents.userId')
        //     ->where('date(documents.created_at) = CURDATE()')
        //     ->orderBy('documents.created_at','desc')
        //     ->get();
        if($request->ajax()){
            return Datatables::of($post)
                ->addIndexColumn()
                ->addColumn('eFile', function($row){
                    $eFile = '<a href='.$row->eFile.'>'.$row->eName.'</a>';
                    return $eFile;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '
                    <i class="material-icons"><a id="edit-doc" data-toggle="modal" data-id='.$row->id.'>edit</a></i>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <i class="material-icons"><a id="delete-doc" data-id='.$row->id.'>delete</a></i>';
                    return $action;
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
        // Storage::disk('local')->putFileAs(
        //     'files/'.$filename,
        //     $uploadedFile,
        //     $filename
        // );

        // $request->validate([
        //     'file' => 'required|mimes:pdf|max:2048'
        // ]);

        // $mDocument = new Documents;

        // if($request->file('eFile')) {
        //     $fileName = time().'_'.$request->file->getClientOriginalName();
        //     $filePath = $request->file('eFile')->storeAs('uploads', $fileName, 'public');
        //     print_r($request->file->getClientOriginalName());exit;
        //     $mDocument->eCode = $request->input('eCode');
        //     $mDocument->eName = time().'_'.$request->file->getClientOriginalName();
        //     $mDocument->eFile = '/storage/' . $filePath;
        //     $mDocument->userId = auth()->id();
        //     $mDocument->save();

        //     // return back()
        //     // ->with('success','File has been uploaded.')
        //     // ->with('file', $fileName);
        //     return redirect()->route("search")->with('message','Success');
        // }else{
        //     print_r("error");exit;
        //     return redirect()->route("search")->with('message','Error');
        // }

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
}
