<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginate){
            $data = Client::where('company_id' , auth()->user()->id)->paginate($request->paginate);
        }else{
            $data = Client::where('company_id' , auth()->user()->id)->get();
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
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
            $user =Client::create($request->all());
            return response()->json([
                'code'    => 200,
                'status'  => 1,
                'errors'  => null,
                'message' => 'success',
                'data'    => $user
            ]);
        }
    }

}
