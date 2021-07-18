<?php

namespace App\Http\Controllers;
use App\Models\MasterDocuments;
use Illuminate\Support\Facades\DB;

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
        $items = DB::table('master_documents')
                ->join('users','users.id','=','master_documents.createUser')
                ->get();
        return view('pages.manage_documents')->with('items',$items);
    }
}
