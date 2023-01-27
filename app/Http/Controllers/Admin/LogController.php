<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $model;
    protected $viewsDomain = 'admin/logs.';
    protected $url = 'admin/logs';

    public function __construct()
    {
        $this->model = new Log();
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $records = Log::where(function ($q) use ($request)
        {
            if ($request->id)
            {
                $q->where('id',$request->id);
            }

            if ($request->logable_type)
            {
                $q->where('logable_type', 'App\Models\\' . $request->logable_type);
            }

            if ($request->logable_id) {
                $q->where('logable_id',  $request->logable_id);
            }

            if ($request->type) {
                $q->where('type',  $request->type);
            }

            if ($request->user_id) {
                $q->where('user_id',  $request->user_id);
            }

            if ($request->from) {
                $q->whereDate('created_at', '>=', $request->from);
            }

            if ( $request->to) {

                $q->whereDate('created_at', '<=', $request->to);
            }
            if ($request->user_name)
            {
                $q->whereHas('admin',function ($q)use($request){
                    $q->where('name',$request->user_name);
                });
            }

            if ($request->model)
            {

            }

        })->latest()->paginate($request->input('paginate' , 15));

        return $this->view('index',compact('records'));
    }
}
