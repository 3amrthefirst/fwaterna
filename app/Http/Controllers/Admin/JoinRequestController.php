<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinRequest;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class JoinRequestController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/join-requests.';
    protected $url = 'admin/join-requests';

    public function __construct()
    {
        $this->model = new JoinRequest();
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
    public function index()
    {
        $records = $this->model->paginate(10);

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
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Support\Facades\Response;
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف طلب إنضمام #' . $record->business);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('consults.index');
    }

    public function downloadPDF($id)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/uploads/pdf/".$this->model->findOrFail($id)->pdf_name.".pdf";

        $headers = array(
                'Content-Type: application/pdf',
                );

        return Response::download($file, 'CV.pdf', $headers);
    }
}
