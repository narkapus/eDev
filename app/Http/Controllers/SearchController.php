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
        $mDocument->eName = 'NULL';
        // $mDocument->eFile = $filename;
        $mDocument->eFile = '/storage/' . $filePath;
        $mDocument->userId = auth()->id();
        $mDocument->save();
        return redirect()->route("search")->with('message','Success');
    }
}
