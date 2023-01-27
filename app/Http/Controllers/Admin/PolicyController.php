<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use Response;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Policy::latest()->paginate(10);
        return view('admin.policies.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Policy();

        return view('admin.policies.create', compact('model'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => 'الاسم مطلوب',
        ];

        $this->validate($request, $rules, $messages);

        $record = Policy::create($request->all());
        session()->flash('success', 'تمت الإضافة بنجاح');

        return redirect(route('policies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Policy::findOrFail($id);
        return view('admin.policies.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
        ];
        $messages = [
            'title.required' => 'الاسم مطلوب',
        ];
        $this->validate($request, $rules, $messages);
        $record = Policy::findOrFail($id);
        $record->update($request->all());
        session()->flash('success', 'تم التعديل بنجاح');

        return redirect(route('policies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Policy::findOrFail($id);

        $record->delete();

        return response()->json([
            'status' => 1,
            'message' => 'تم الحذف بنجاح',
            'id' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */

}
