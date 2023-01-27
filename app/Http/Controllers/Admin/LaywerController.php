<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Helper\Attachment;
use App\Models\Laywer;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;

class LaywerController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/laywers.';
    protected $url = 'admin/laywers';


    public function __construct()
    {
        $this->model = new Laywer();
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
    public function index(Request $request)
    {
        $records = $this->model->where(function ($q) use ($request) {
            if ($request->name) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->latest()->paginate(10);

        $totalRecords = $records->count();

        return $this->view('index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->model ;
        $edit = false ;
        return  $this->view('create',compact('model','edit'));
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
            'name'          => 'required',
        ];
        $messages = [
            'name.required' => 'إسم المحامي مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = $this->model->create($request->all());
        if ($request->has('image')) {
            Attachment::addAttachment($request->image, $record, 'laywers', ['save' => 'original', 'usage' => 'img']);
        }
        Log::createLog($record, auth()->user(), 'عملية اضافة', 'إضافة محامي #' . $record->name);
        session()->flash('success', __('تم الإضافة'));
        return redirect(route('laywers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laywer  $laywer
     * @return \Illuminate\Http\Response
     */
    public function show(Laywer $laywer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        $edit = true;
        return $this->view('edit', compact('model', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules = [
            'name'          => 'required',
            'image'         => 'required'
        ];
        $messages = [
            'name.required' => 'إسم المحامي مطلوب',
            'image.required' => 'صورة المحامي مطلوبة',
        ];
        $this->validate($request, $rules, $messages);

        $record = $this->model->findOrFail($id);
        $record->update($request->all());

        $oldFile = $record->attachmentRelation[0] ?? null;
        if ($request->has('image')) {
            Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
            Attachment::updateAttachment($request->image,$oldFile , $record, 'laywers', ['save' => 'original', 'usage' => 'img']);
        }

        Log::createLog($record, auth()->user(), 'عملية تعديل', 'تعديل محامي #' . $record->name);
        session()->flash('success', __('تم التعديل'));
        return redirect(route('laywers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
        $record->delete();
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف محامي #' . $record->name);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('laywers.index');
    }
}
