<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;


class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'votes'=>'required|numeric'
        ]);
         
            $post=new post();
            $post->fill(
                $request->only('title','content','votes')
            );

            $post->save();
            $value=[
                'code'=>0,
                'data'=>$post
            ];

            return $value;

    }
    public function update(Request $request,$id)
    {
        $post=post::find($id);
        if( is_null($post)){
            return response()->json(['message'=>"id not exist"]);
        }
        $post->update(
            $request->only('title','content','votes')
        );
        $value=[
            'code'=>0,
            'data'=>$post
        ];
        return $value;
    }
}
