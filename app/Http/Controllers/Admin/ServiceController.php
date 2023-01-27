<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Helper\Attachment;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/services.';
    protected $url = 'admin/services';


    public function __construct()
    {
        $this->model = new Service();
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
        $records = $this->model->all();
        return $this->view('index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $model = $this->model ;
        // $edit = false ;
        // return  $this->view('create',compact('model','edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'title' => 'required',
        //     'content' => 'required',
        //     'image' => 'required',
        // ];
        // $messages = [
        //     'title.required' => 'عنوان الخدمة مطلوب',
        //     'content.required' => 'محتوى الخدمة مطلوب',
        //     'image.required' => 'اللوجو مطلوب',
        // ];
        // $this->validate($request, $rules, $messages);
        // $record = $this->model->create($request->all());
        // if ($request->has('image')) {
        //     Attachment::addAttachment($request->image, $record, 'services', ['save' => 'original', 'usage' => 'img']);
        // }
        // Log::createLog($record , auth()->user() ,'عملية اضافة' ,'اضافة خدمة #' . $record->id);

        // session()->flash('success', 'تم الإضافة');
        // return redirect(route('services.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
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
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = $this->model->findOrFail($id);
        $rules = [
            'title.*' => 'required',
            'content.*' => 'required',
        ];
        $messages = [
            'title.*.required' => 'عنوان الخدمة مطلوب',
            'content.*.required' => 'محتوى الخدمة مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = $this->model->findOrFail($id);
        $record->update([
            $record->setTranslation('title', 'ar', $request->title['ar']),
            $record->setTranslation('title', 'en', $request->title['en']),
            $record->setTranslation('content', 'ar', $request->content['ar']),
            $record->setTranslation('content', 'en', $request->content['en']),
        ]);

        $oldFile = $record->attachmentRelation[0] ?? null;
        if ($request->has('image')) {
            Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
            Attachment::updateAttachment($request->image,$oldFile , $record, 'services', ['save' => 'original', 'usage' => 'img']);
        }

        Log::createLog($record , auth()->user() ,'عملية تعديل' ,'تعديل خدمة #' . $record->id);
        session()->flash('success','تم التعديل');
        return redirect(route('services.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
        $record->delete();
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف خدمة #' . $record->name);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('services.index');
    }
}
