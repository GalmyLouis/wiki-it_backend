<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\page;
use App\Models\pageHistory;
use Illuminate\Support\Facades\DB;

class pageController extends Controller
{
    public function index()
    {
        $page=(new page())->paginate();
        return $page;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string'
        ]);
        $page=new page();
        $pageHistory=new pageHistory();
        $pageHistory->version=1;
        $pageHistory->status='Created';
        $page->lastVersion=1;
        $pageHistory->fill(
            $request->only('author','status','content','version','page_id')
        );
        $page->fill(
            $request->only('title','content','lastVersion')
        );
        $page->save();
        $page->pageHistory()->save($pageHistory);

        $value=[
            'code'=>0,
            'data'=>['page'=>$page]
       ];
        return  $value;
        
    }
    public function verificationName(Request $request){
        $value=DB::table('pages')->where('title',$request->title)->value('title');
        if($value!=null){
            $page=['code'=>0];
        }else{
            $page=['code'=>1];
        }

       
        return $page;
    }
    public function searchPage(Request $request, page $page)
    {
        $value=DB::table('pages')->where('title',$request->title)->value('title');
        $page=DB::table('pages')->where('title',$request->title)->get();
        if($value!=null){
            $value=['code'=>0,
                    'data'=>$page
                   ];
        }else{
            $value=['code'=>1];
        } 
        return $value; 
    }
    public function searchData(Request $request)
    {
        $page=DB::table('pages')->where('title','like','%'.$request->title.'%')->orWhere('content','like','%'.$request->title.'%')->get();
        return $page;
    }

    public function update(Request $request,$id)
    {
        $page=page::find($id);
        if( is_null($page)){
            return response()->json(['message'=>"data don't find"]);
        }
        
        
         $pageHistory=new pageHistory();
        
         $value1=DB::table('page_histories')->where('page_id',$id)->max('version');
         $page->lastVersion=$value1 + 1;
         $pageHistory->version=$value1 + 1;
         $pageHistory->status='Modificated';
         $page->update(
            $request->only('title','content','lastVersion')
         );
         $pageHistory->fill(
            $request->only('author','status','content','version','page_id')
        );
        $page->pageHistory()->save($pageHistory);

        $value=[
            'code'=>0,
            'data'=>['page'=>$page]
       ];

         return $value;

    }
}
