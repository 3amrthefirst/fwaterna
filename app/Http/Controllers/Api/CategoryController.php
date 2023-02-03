<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subscribtion;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->paginate){
            $data = Category::where('company_id' , auth()->user()->id)->paginate($request->paginate);
        }else{
            $data = Category::where('company_id' , auth()->user()->id)->get();
        }

        return response()->json([
            'code'    => 200,
            'status'  => 1,
            'errors'  => null,
            'message' => 'success',
            'data'    => $data
        ]);

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
        $rules = [
            'title' => 'required',
            'company_id' => 'required|exists:companies,id' ,
        ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails())
        {
            return response()->json([
                'code'    => 422,
                'status'  => 1,
                'errors'  => $data->errors(),
                'message' => 'failed',
                'data'    => null
            ]);
        }else{
            $user =Category::create($request->all());
            return response()->json([
                'code'    => 200,
                'status'  => 1,
                'errors'  => null,
                'message' => 'success',
                'data'    => $user
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
