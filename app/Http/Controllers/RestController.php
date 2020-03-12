<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Jobs\ListJob;
use App\Rest;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = Cache::rememberForever('list', function(){
            return Rest::with('articles')->get();
        });
        return $data;
        //  Cache::set('my', Rest::with('articles')->get());
        // echo Cache::get('my');      
        // return Rest::take(1)->orderBy('id', 'DESC')->select('first_name', 'last_name')->get();
        // return Rest::all();      
        // return Rest::select('first_name', 'last_name')->get();       
        // return response()->json(['firstname'=>'emeka', 'lastname'=>'okwuosa']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'first_name'=>'required',
        'last_name'=>'required',
        'fullname' => 'required'
      ]);      
    
    //   $list = new Rest; 
    //   $list->first_name = $request->input('first_name');
    //   $list->last_name = $request->input('last_name');
    //   $list->fullname = $request->input('fullname');
    //   $list->save();
      ListJob::dispatch($request);
    //  dispatch(new ListJob($request));
      Cache::forget('list');
      return response()->json(['message'=>'List Added Successfully']);       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rest::find($id); 
        // return Rest::where('id','=',$id)->get(); 
        // return Rest::where('first_name', 'kene')->where('last_name', 'Okeke')->exists();         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $list = Rest::find($id); 
        $list->first_name = $request->input('first_name');
        $list->last_name = $request->input('last_name');
        $list->fullname = $request->input('fullname');
        $list->save();
        Cache::forget('list');
        return $list; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = Rest::find($id);         
        $list->delete();
        return response()->json(['message'=>'List deleted successfully']);
    }   
}
