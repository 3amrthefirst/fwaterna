<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Log;
use App\MyHelper\Helper;
use Illuminate\Http\Request;
use Response;

class ContactController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/contacts.';
    protected $url = 'admin/contacts';


    public function __construct()
    {
        $this->model = new Contact();
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
    public function store(Request $request,$lang)
    {
        if($lang == 'ar')
        {
            $rules = [
                'full_name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ];
            $messages = [
                'full_name.required' => 'الإسم مطلوب',
                'email.required' => 'البريد الإلكتروني',
                'message.required' => 'الرسالة مطلوبة',
            ];
        }
        else{
            $rules = [
                'full_name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ];
            $messages = [
                'full_name.required' => 'Full name required',
                'email.required' => 'Email required',
                'message.required' => 'Message required',
            ];
        }
    
        $this->validate($request, $rules, $messages);
                $record = $this->model->create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
        Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف إستشارة #' . $record->business);
        session()->flash('success', __('تم الحذف'));
        return redirect()->route('contacts.index');
    }
}
