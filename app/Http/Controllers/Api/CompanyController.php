<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Subscribtion;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\TokenRepository;


class CompanyController extends Controller
{

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|min:8' ,
            'email' => 'required|email|unique:companies,email',
            'phone' => 'required'
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
            $user =Company::create($request->all());
            return response()->json([
                'code'    => 200,
                'status'  => 1,
                'errors'  => null,
                'message' => 'success',
                'data'    => $user
            ]);
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'password' => 'required|min:8' ,
            'email' => 'required|email|exists:companies,email',
        ];

        $data = validator()->make($request->all(), $rules);
        if ($data->fails())
        {
            return response()->json([
                'code'    => 422,
                'status'  => 1,
                'errors'  => $data->errors(),
                'message' => 'bad Credentials',
                'data'    => null
            ]);
        }else{
            $user = Company::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'code'    => 422,
                    'status'  => 1,
                    'errors'  => $data->errors(),
                    'message' => 'bad Credentials',
                    'data'    => null
                ]);
            }
            $user['token'] = $user->createToken('passport_token')->accessToken;
            return response()->json([
                'code'    => 200,
                'status'  => 1,
                'errors'  => null,
                'message' => 'success',
                'data'    => $user
            ]);
        }

    }

    public function logout()
    {
        $token = auth()->user()->token();

        $tokenReposetory = app(TokenRepository::class);
        $tokenReposetory->revokeAccessToken($token->id);
        return response()->json([
            'code'    => 200,
            'status'  => 1,
            'errors'  => null,
            'message' => 'logout success',
            'data'    => null
        ]);
    }

    public function subscription()
    {
        $data = Subscribtion::all();
        return response()->json([
            'code'    => 200,
            'status'  => 1,
            'errors'  => null,
            'message' => 'success',
            'data'    => $data
        ]);

    }

    public function makeSubscription(Request $request)
    {
        $rules = [
            'company_id' => 'required|exists:companies,id' ,
            'subscription_id' => 'required|exists:subscribtions,id',
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
            $user = Company::findOrFail($request->company_id);
            $subscription = Subscribtion::findOrFail($request->subscription_id);
            $user->subscribe_id = $request->subscription_id;
            $user->subscription_end_date = now()->addDays($subscription->days) ;
            $user->save();
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \response()->json(auth()->user());
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
        //
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
