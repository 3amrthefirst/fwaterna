<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\MyHelper\Helper;
use App\MyHelper\Photo;
use DB;
use Helper\Attachment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Log;
use App\User;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Response;
use Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $model;
    protected $guard = 'admin';
    protected $url = 'admin/users/';
    protected $viewsDomain = 'admin.users.';

    public function __construct()
    {
        $this->model = new Role();
        $this->guard = 'admin';
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

    public function changePassword()
    {
        return view('facilities.reset-password');
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'old-password' => 'required',
            'password'     => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->input('old-password'), $user->password)) {
            // The passwords match...
            $user->password = bcrypt($request->input('password'));
            $user->save();
            session()->flash('success', 'تم تحديث كلمة المرور');
            return view('facilities.reset-password');
        } else {
            session()->flash('fail', 'كلمة المرور غير صحيحة');
            return view('facilities.reset-password');
        }

    }

    public function index(Request $request)
    {
        $admin = auth($this->guard)->user();


        $users = $admin->where(function ($q) use ($request)
        {
            if ($request->id)
            {
                $q->where('id',$request->id);
            }
            if ($request->name) {
                $q->where(function ($q) use ($request) {

                    $q->where('name', 'LIKE', '%' . $request->name . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->name . '%');
                });
            }
            if ($request->role_name) {

                $q->whereHas('roles', function ($q) use ($request) {

                    $q->where('name', 'LIKE', '%' . $request->role_name . '%');
                });
            }

            if ($request->from) {
                $q->whereDate('created_at', '>=', Helper::convertDateTime($request->from));
            }

            if ($request->to) {
                $q->whereDate('created_at', '<=', Helper::convertDateTime($request->to));
            }


        })->latest()->paginate(20);
        return $this->view('index', compact('users'));
    }

    public function create(User $model)
    {
        $model = new User();
        $roles = Role::all();
//        $governorates = Governorate::all();

        return view('admin.users.create', compact('model', 'roles'));
    }

    public function store(Request $request)
    {
        $rules =
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed',
                'roles.*' => 'required|exists:roles,id',
            ];

        $error_sms =
            [
//                'name.required' => 'الرجاء ادخال الاسم ',
//                'email.unique' => ' البريد الالكتروني موجود بالفعل',
//                'email.required' => 'الرجاء ادخال البريد الالكتروني',
//                'password.required' => 'الرجاء ادخال كلمة المرور',
//                'password.confirmed' => 'الرجاء التاكد من كلمة المرور ',

        ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }
        $user = User::create(request()->all());

        $user->update(['password' => Hash::make($request->password)]);

        $user->assignRole($request->roles);

        // update governorates roles
//        $user->governorates()->sync($request->governorates);

//        Log::createLog($user , auth()->user() , 'إضافة مستخدم لوحة تحكم #' . $user->id);
        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('/admin/users');
    }

    public function show($id)
    {
        /* $user = User::with('addresses')->findOrFail($id);
         $orders = $user->orders()->latest()->paginate(5);
         return view('facilities.sushi.user',compact('user','orders'));*/
    }

    public function edit($id)
    {


        $facility = auth($this->guard)->user();

        $model =  User::findOrFail($id);
        $roles =  Role::all();;


        return $this->view('edit', compact('model', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $facility = auth($this->guard)->user();

        $record = $facility->findOrFail($id);
        $rules =
            [
                'name'     => 'required',
                'email'    => 'required|unique:users,email,' . $record->id . '',
                'password' => 'confirmed',
                'roles.*'  => 'required|exists:roles,id',
            ];

        $error_sms =
            [
                'name.required'      => 'الرجاء ادخال الاسم ',
                'email.required'     => 'الرجاء ادخال البريد الالكتروني',
                'email.unique'       => ' البريد الالكتروني موجود بالفعل',
                'password.confirmed' => 'الرجاء التاكد من كلمة المرور ',

            ];
        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return redirect($this->url . $id . '/edit')->withInput()->withErrors($data->errors());
        }


        $record->update($request->except('password'));

        if ($request->has('password') && $request->password != null) {
            $record->update(['password' => Hash::make($request->password)]);
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $record->assignRole($request->roles);

        session()->flash('success', 'تم التعديل بنجاح');
        return back();

    }

    public function destroy($id)
    {
        $users = auth($this->guard)->user();
        $record = $users->findOrFail($id);

        if (auth($this->guard)->user()->id == $record->id) {
            $data = [
                'status' => 0,
                'msg'    => 'This email, you cannot deactivate it',
                'id'     => $id
            ];

            return Response::json($data, 200);

        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $record->delete();

        $data = [
            'status' => 1,
            'msg'    => 'Deleted successfully',
            'id'     => $id
        ];

        return Response::json($data, 200);
    }

    public function toggleBoolean($id , $action)
    {
        $users = auth($this->guard)->user();
        $record = $users->findOrFail($id);

        if(auth($this->guard)->user()->id == $id )
        {
            return Helper::responseJson(0,'لا يمكنك إلغاء تفعيل حسابك');
        }

        $activate = Helper::toggleBoolean($record , $action);

        if ($activate) {
            return Helper::responseJson(1,'تمت العملية بنجاح');
        }

        return Helper::responseJson(0,'حدث خطأ');
    }

    public function home()
    {
        return view('admin.layouts.home');
    }

    public function updateProfileView()
    {
        return view('admin.users.update-profile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
        ]);

        $user = Auth::user();
        $oldFile = $user->attachmentRelation[0] ?? null;

        if ($request->hasFile('photo')) {

            Attachment::updateAttachment($request->file('photo'), $oldFile, $user, 'users/profile', ['save' => 'original']);
        }

        if ($request->input('old-password')) {
            $this->validate($request, [
                'old-password' => 'required',
                'password' => 'required|confirmed',
            ]);

            if (Hash::check($request->input('old-password'), $user->password)) {
                // The passwords match...
                $user->password = bcrypt($request->input('password'));
                $user->save();
            } else {
                session()->flash('fail', 'كلمة المرور غير صحيحة');
                return view('admin.users.update-profile');
            }
        }

       Log::createLog($user , auth()->user() , 'عملية تعديل','تعديل بيانات البروفايل الخاص به #' . $user->id);

        session()->flash('success', __('تم التعديل بنجاح'));
        return redirect('admin/update-profile');
    }
}
