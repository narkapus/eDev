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
    public function index()
    {
        $items = DB::table('master_documents')->take(10)
                ->join('users','users.id','=','master_documents.createUser')
                ->orderBy('master_documents.created_at','desc')
                ->get();
        return view('pages.manage_documents')->with('items',$items);
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
}
