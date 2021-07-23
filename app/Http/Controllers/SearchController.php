<?php

namespace App\Http\Controllers;
// use Storage;
use App\Models\MasterDocuments;
use App\Models\Documents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $search = $request->input('search');
        $userId = $request->input('userId');
        $fullName = $request->input('fullName');

        $items = MasterDocuments::pluck('eName');
        $user = User::pluck('name');

        $posts = DB::table('documents')->select('eCode','eName','name','documents.created_at')->take(10)
                ->join('users','users.id','=','documents.userId');
                if($search){
                    $posts->where('eCode','=',$search);
                }
                if($userId){
                    $posts->Where('userId','=',$userId);
                }
                if($fullName){
                    $posts->Where('name','like','%'.$fullName.'%');
                }
                $post = $posts->orderBy('documents.created_at','desc')
                ->get();
        return view('pages.search',compact('items','user','post'));
    }
}
