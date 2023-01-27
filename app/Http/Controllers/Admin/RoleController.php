<?php

namespace App\Http\Controllers\Admin;


use App\MyHelper\Helper;

use App\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class RoleController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where(function ($q) use ($request) {

                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                });
            }

            if ($request->from) {
                $q->whereDate('created_at', '>=', \App\MyHelper\Helper::convertDateTime($request->from));
            }

            if ($request->to) {
                $q->whereDate('created_at', '<=', Helper::convertDateTime($request->to));
            }




            $q->where('id','!=','1');
        })->latest()->paginate(20);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Artisan::call('permission:cache-reset');
        $model = new Role();
        $permissions = Permission::select('group')->groupBy('group')->get();
        return view('admin.roles.create', compact('model', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=
            [
                'name'=>'required|unique:roles',
//                'display_name'=>'required',
//            'description'=>'required',
            'permissions'=>'required',

        ];

        $message=
            [
                'name.required'=>'الرجاء ادخال الاسم',
                'name.unique'=>'تم ادخال هذه الصلاحية من قبل',
                'display_name.required'=>'الرجاء ادخال الاسم المعروض',
                'description.required'=>'الرجاء ادخال الوصف',
                'permissions.required'=>'الرجاء ادخال الوصف'

            ];

        $data = validator()->make($request->all(),$rules , $message);
        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = Role::create(request()->except('permissions','sellectAll'));
        $record->permissions()->attach($request->permissions);

        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('admin/roles');
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
//        if($id == 1)
//        {
//            flash()->success(__('لا يمكن تعديل هذه الصلاحية'));
//            return redirect('admin/role');
//        }

        Artisan::call('permission:cache-reset');
        $model = Role::findOrFail($id);

        $permissions = Permission::select('group')->groupBy('group')->get();
        return view('admin.roles.edit', compact('model' , 'permissions'));
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
        if($id == 1)
            return redirect('admin/roles');

        $record = Role::findOrFail($id);

        $rules=
            [
                'name'=>'required|unique:roles,name,'.$record->id.'',
//                'display_name'=>'required',
//            'description'=>'required',
            'permissions'=>'required',

        ];

        $message=
            [
                'name.required'=>'الرجاء ادخال الاسم',
                'name.unique'=>'تم اخال هذه الصلاحية من قبل',
                'display_name.required'=>'الرجاء اخال الاسم المعروض',
                'description.required'=>'الرجاء اخال الوصف'

            ];
        $data = validator()->make($request->all(),$rules,$message);

        if($data->fails())
        {
            return back()->withInput()->withErrors($data->errors());
        }

        $record ->update($request->except('permissions','sellectAll'));
        $record->permissions()->sync($request->permissions);

        session()->flash('success', 'تمت التعديل بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $record = Role::findOrFail($id);

        $users = $record->users()->get();

        if(!count($users) || $id != 1)
        {
            $record->permissions()->detach();
            $record->delete();

            $data = [
                'status' => 1,
                'msg' => __('تم الحذف بنجاح'),
                'id' => $id
            ];
            return Response::json($data, 200);
        }else
        {
            $data = [
                'status' => 0,
                'msg' => ' فشل الحذف , يوجد مستخدمين مرتبطين بهذه الصلاحية',
                'id' => $id
            ];
            return Response::json($data, 200);
        }
    }
}
