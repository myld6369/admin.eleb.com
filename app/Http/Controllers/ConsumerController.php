<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    //
    public function index(Request $request)
    {
        $consumers =Consumer::paginate(5);
        if (!empty($request->keyword)){
            $consumers =Consumer::where('username','like','%'.$request->keyword.'%')->paginate(5);
        }
        $data=[
            'username'=>$request->keyword
        ];
        return view('Consumer/index',compact('consumers','data'));
    }

    public function show(Consumer $consumer)
    {
        return view('Consumer/show',compact('consumer'));
    }

    public function update(Consumer $consumer)
    {
        if ($consumer->status==0){
            $consumer->update([
                'status'=>1
            ]);
        }elseif ($consumer->status==1){
            $consumer->update([
                'status'=>0
            ]);
        }
        return redirect()->route('consumers.index');
    }
}
