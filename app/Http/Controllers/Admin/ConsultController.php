<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/consults.';
    protected $url = 'admin/consults';


    public function __construct()
    {
        $this->model = new Consult();
        $this->helper = new Helper();

    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $records = $this->model->where(function ($q) use ($request) {
            if ($request->business) {
                $q->where('business','LIKE','%'. $request->business .'%');
            }
        })->orderBy('id', 'DESC')->paginate(10);

        $totalRecords = $records->count();

        return $this->view('index', compact('records', 'totalRecords'));
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
     * @param  \App\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function show(Consult $consult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        $edit = true ;
        return $this->view('edit', compact('model','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = $this->model->findOrFail($id);
        $rules = [
            'answer' =>'required'
        ];

        $messages = [
            'answer.required' => 'الرد مطلوب'
        ];

        $this->validate($request, $rules, $messages);
        $record->update([
            'answer' => $request->answer
        ]);

        Log::createLog($record , auth()->user() ,'عملية رد' ,'رد على إستشارة #' . $record->id);
        session()->flash('success', 'تمت تسجيل الرد بنجاح');
        return redirect($this->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف إستشارة #' . $record->business);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('consults.index');
    }
}
