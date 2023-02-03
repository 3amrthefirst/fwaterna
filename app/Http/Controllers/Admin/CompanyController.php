<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Company;
use App\MyHelper\Helper;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $model;
    protected $helper;
    protected $viewsDomain = 'admin/company.';
    protected $url = 'admin/companies';


    public function __construct()
    {
        $this->model = new Company();
        $this->helper = new Helper();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

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
        })->latest()->paginate(10);
        $totalRecords = $records->count();
        return $this->view('index', compact('records'));
    }

        public function clients(Request $request , $id)
    {
        $records = Client::where('company_id' , $id )->where(function ($q) use ($request) {
            if ($request->name) {
                $q->where('name','LIKE','%'. $request->name .'%');
            }
            if ($request->phone) {
                $q->where('phone','LIKE','%'. $request->phone .'%');
            }
            if ($request->email) {
                $q->where('email','LIKE','%'. $request->email .'%');
            }
        })->latest()->paginate(10);
        $totalRecords = $records->count();
        return view('admin.company.clients-index', compact('records'));
    }

    public function categories(Request $request , $id)
    {
        $records = Category::where('company_id' , $id )->where(function ($q) use ($request) {
            if ($request->name) {
                $q->where('title','LIKE','%'. $request->name .'%');
            }

        })->latest()->paginate(10);
        $totalRecords = $records->count();
        return view('admin.company.categories-index', compact('records'));
    }

}
