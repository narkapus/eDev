<?php

namespace App\Http\Controllers;
use App\Models\MasterDocuments;

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
        $items = MasterDocuments::all();
        return view('pages.manage_documents')->with('items',$items);
    }
}
