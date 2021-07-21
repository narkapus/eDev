<?php

namespace App\Http\Controllers;
use App\Models\MasterDocuments;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ManageDocumentController extends Controller
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
        echo $request->eCode;
        $items = DB::table('master_documents')->take(10)
                ->join('users','users.id','=','master_documents.createUser')
                ->orderBy('master_documents.created_at','desc')
                ->get();
        $geteDoc = DB::table('master_documents')->where('eCode','1')->get();
        return view('pages.manage_documents',['items' => $items,'geteDoc' => $geteDoc]);
    }

    public function create(Request $request)
    {
        $mDocument = new MasterDocuments();

        $mDocument->eCode = $request->input('eCode');
        $mDocument->eName = $request->input('eName');
        $mDocument->createUser = auth()->id();
        $mDocument->save();
        return redirect()->route("manage")->with('message','Success');
    }

    public function edit($eName){
         print_r(5555);
    }
}
