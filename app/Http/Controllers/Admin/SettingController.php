<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Log;

use Illuminate\Http\Request;

class SettingController extends Controller
{

    protected $model;
    protected $viewsDomain = 'admin/settings.';
    protected $viewsUrl = 'admin/settings';

    public function __construct()
    {
        $this->model = new Setting();
    }

    /**
     * @param $lang
     */
    public function view($lang)
    {
        
    }

     /**
     * Display a listing of the resource.
     */
    public function index($lang)
    {
        if($lang == 'ar')
        {
            $record = $this->model->first();
            return view('admin.settings.index-ar',compact('record'));
        }
        if($lang == 'en'){
            $record = $this->model->first();
            return view('admin.settings.index-en',compact('record'));
        }else
        {
            $record = $this->model->first();
            return view('admin.settings.index',compact('record'));
        }
    }

    public function update(Request $request,$lang)
    {
        if($lang == 'ar' || $lang == 'en')
        {
            $rules = [
                'site_name.*' => 'required|nullable|max:200',
                'about_us.*' => 'required|nullable|max:200',
                'goal.*' => 'required|nullable|max:200',
                'our_services_sub_title.*' => 'required|nullable|max:200',
                'commercial_issues_sub_title.*' => 'required|nullable|max:200',
                'our_team_sub_title.*' => 'required|nullable|max:200',
                'our_clients_sub_title.*' => 'required|nullable|max:200',
                'faq_sub_title.*' => 'required|nullable|max:200',
                'blog_sub_title.*' => 'required|nullable|max:200'
            ];
    
            $messages = [
                'site_name.*.required' => 'إسم الموقع مطلوب',
                'site_name.*.max' => 'إسم الموقع اطول من اللازم',
                'about_us.*.required' => 'نص من نحن مطلوب',
                'about_us.*.max' => 'نص من نحن اطول من اللازم',
                'goal.*.required' => 'نص هدفنا مطلوب',
                'goal.*.max' => 'نص هدفنا اطول من اللازم',
                'our_services_sub_title.*.required' => 'نص خدماتنا مطلوب',
                'our_services_sub_title.*.max' => 'نص خدماتنا اطول من اللازم',
                'commercial_issues_sub_title.*.required' => 'نص التعداد مطلوب',
                'commercial_issues_sub_title.*.max' => 'نص التعداد اطول من اللازم',
                'our_team_sub_title.*.required' => 'نص فريفنا مطلوب',
                'our_team_sub_title.*.max' => 'نص فريفنا اطول من اللازم',
                'our_clients_sub_title.*.required' => 'نص عملائنا مطلوب',
                'our_clients_sub_title.*.max' => 'نص عملائنا اطول من اللازم',
                'faq_sub_title.*.required' => 'نص الإستشارات مطلوب',
                'faq_sub_title.*.max' => 'نص الإستشارات اطول من اللازم',
                'blog_sub_title.*.required' => 'نص المدونة مطلوب',
                'blog_sub_title.*.max' => 'نص المدونة اطول من اللازم',
            ];
    
            $this->validate($request, $rules, $messages);
    
            $record = $this->model->first();
            $record->update([
                $record->setTranslation('site_name', $lang, $request->site_name[$lang]),
                $record->setTranslation('about_us', $lang, $request->site_name[$lang]),
                $record->setTranslation('goal', $lang, $request->site_name[$lang]),
                $record->setTranslation('our_services_sub_title', $lang, $request->site_name[$lang]),
                $record->setTranslation('commercial_issues_sub_title', $lang, $request->site_name[$lang]),
                $record->setTranslation('our_team_sub_title', $lang, $request->site_name[$lang]),
                $record->setTranslation('our_clients_sub_title', $lang, $request->site_name[$lang]),
                $record->setTranslation('faq_sub_title', $lang, $request->site_name[$lang]),
                $record->setTranslation('blog_sub_title', $lang, $request->site_name[$lang]),
            ]);        

            Log::createLog($record , auth()->user() ,'عملية تعديل' ,'تعديل اعدادات الموقع');
            session()->flash('success', 'تمت التعديل بنجاح');
            return redirect(route('settings.index',$lang));
        }
        else
        {
            $rules = [
                'phone'             => 'required',
                'email'             => 'required|email',
                'twitter'           => 'required',
                'linkedin'          => 'required',
                'expert_laywers'    => 'required|numeric',
                'closed_cases'      => 'required|numeric',
                'successful_casses' => 'required|numeric',
                'trusted_client'    => 'required|numeric',
            ];
    
            $messages = [
                'phone.required'    => 'رقم الهاتف مطلوب',
                'email.required'    => 'البريد اﻹلكتروني مطلوب',
                'email.email'       => 'صيغة البريد اﻹلكتروني غير صحيحة',
                'twitter.required'  => 'لينك حساب تويتر مطلوب',
                'linkedin.required' => 'لينك حساب لينكد إن مطلوب',
                'expert_laywers.required' => 'عدد المحامين الخبراء مطلوب',
                'closed_cases.required' => 'عدد القضايا المغلقة مطلوب',
                'successful_casses.required' => 'عدد الحالات الناجحة مطلوب',
                'trusted_client.required' => 'عدد العملاء الموثوق بهم يجب ان يكون رقما',
                'expert_laywers.numeric' => 'عدد المحامين الخبراء يجب ان يكون رقما',
                'closed_cases.numeric' => 'عدد القضايا المغلقة يجب ان يكون رقما',
                'successful_casses.numeric' => 'عدد الحالات الناجحة يجب ان يكون رقما',
                'trusted_client.numeric' => 'عدد العملاء الموثوق بهم يجب ان يكون رقما',
            ];

            $this->validate($request, $rules, $messages);

            $record = $this->model->first();
            $record->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'expert_laywers' => $request->expert_laywers,
                'closed_cases' => $request->closed_cases,
                'successful_casses' => $request->successful_casses,
                'trusted_client' => $request->trusted_client,
            ]);        
            $record->save();

            Log::createLog($record , auth()->user() ,'عملية تعديل' ,'تعديل اعدادات الموقع');
            session()->flash('success', 'تمت التعديل بنجاح');
            return redirect(route('settings.index',$lang));
        }
        

    }

}
