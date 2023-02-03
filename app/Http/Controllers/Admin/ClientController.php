<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Helper\Attachment;
use App\Models\Client;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/clients.';
    protected $url = 'admin/clients';


    public function __construct()
    {
        $this->model = new Client();
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
                $q->where('name','LIKE','%'. $request->name .'%');
            }
            if ($request->phone) {
                $q->where('phone','LIKE','%'. $request->phone .'%');
            }
            if ($request->email) {
                $q->where('email','LIKE','%'. $request->email .'%');
            }
            if ($request->fax) {
                $q->where('fax','LIKE','%'. $request->fax .'%');
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required',
        ];
        $messages = [
            'name.required' => 'الاسم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'email.required'=> 'البريد اﻹلكتروني مطلوب',
            'image.required' => 'اللوجو مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = $this->model->create($request->all());
        if ($request->has('image')) {
            Attachment::addAttachment($request->image, $record, 'clients', ['save' => 'original', 'usage' => 'img']);
        }
        Log::createLog($record , auth()->user() ,'عملية اضافة' ,'اضافة عميل #' . $record->id);
        session()->flash('success', 'تم الإضافة');
        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);
        $edit = true ;
        return $this->view('edit', compact('model','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = $this->model->findOrFail($id);
        $rules = [
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required',
            'fax'   => 'required',
        ];
        $messages = [
            'name.required' => 'الاسم مطلوب',
            'phone.required'=> 'رقم الهاتف مطلوب',
            'email.required'=> 'البريد اﻹلكتروني مطلوب',
            'fax.required'  => 'الفاكس مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = $this->model->findOrFail($id);
        $record->update($request->all());

        $oldFile = $record->attachmentRelation[0] ?? null;
        if ($request->has('image')) {
            Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
            Attachment::updateAttachment($request->image,$oldFile , $record, 'clients', ['save' => 'original', 'usage' => 'img']);
        }

        Log::createLog($record , auth()->user() ,'عملية تعديل' ,'تعديل عميل #' . $record->id);
        session()->flash('success','تم التعديل');
        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
        $record->delete();
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف عميل #' . $record->name);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('clients.index');
    }
}
