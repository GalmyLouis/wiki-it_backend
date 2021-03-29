<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\pageHistory;

use Illuminate\Http\Request;

class pageHistoryController extends Controller
{
    public function index()
    {
        $pgh=(new pageHistory())->paginate();
        return $pgh;
    }



    public function consultData($id)
    {
        $data=DB::table('page_histories')->where('page_id',$id)->get();
        $value=[
            'code'=>0,
            'data'=>['page'=>$data]
       ];
       return $value;
    }
}
