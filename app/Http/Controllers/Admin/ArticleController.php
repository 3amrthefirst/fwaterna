<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Helper\Attachment;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/articles.';
    protected $url = 'admin/articles';


    public function __construct()
    {
        $this->model = new Article();
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'price' => 'required',
        ];
        $messages = [
            'title.required' => 'عنوان المقالة مطلوب',
            'content.required' => 'محتوى المقالة مطلوب',
            'image.required' => 'صورة الغلاف مطلوبة',
            'price.required' => '  السعر مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = $this->model->create($request->all());
        if ($request->has('image')) {
            Attachment::addAttachment($request->image, $record, 'articles', ['save' => 'original', 'usage' => 'img']);
        }
        Log::createLog($record , auth()->user() ,'عملية اضافة' ,'اضافة مقال #' . $record->id);

        session()->flash('success', 'تم الإضافة');
        return redirect(route('articles.index'));
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
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => 'عنوان المقالة مطلوب',
            'content.required' => 'محتوى المقالة مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = $this->model->findOrFail($id);
        $record->update($request->all());

        $oldFile = $record->attachmentRelation[0] ?? null;
        if ($request->has('image')) {
            Attachment::deleteAttachment($record, 'attachmentRelation', false, 'image');
            Attachment::updateAttachment($request->image,$oldFile , $record, 'articles', ['save' => 'original', 'usage' => 'img']);
        }

        Log::createLog($record , auth()->user() ,'عملية تعديل' ,'تعديل مقالة #' . $record->id);
        session()->flash('success','تم التعديل');
        return redirect(route('articles.index'));
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
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف مقالة #' . $record->name);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('articles.index');
    }
}
