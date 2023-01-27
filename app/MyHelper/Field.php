<?php

namespace App\MyHelper;

use Carbon\Carbon;
use Form;


/**
 * to create dynamic fields for modules
 */
class Field
{
    public function isDeferred(){
        return false;
    }
    public static $months = [
        "1" => 'يناير',
        "2" => 'فبراير',
        "3" => 'مارس',
        "4" => 'أبريل',
        "5" => 'مايو',
        "6" => 'يونيو',
        "7" => 'يوليو',
        "8" => 'أغسطس',
        "9" => 'سبتمبر',
        "10" => 'أكتوبر',
        "11" => 'نوفمبر',
        "12" => 'ديسمبر'
    ];

    public static $hijriMonths = [
        "1" => 'محرم',
        "2" => 'صفر',
        "3" => 'ربيع الأول',
        "4" => 'ربيع الثاني',
        "5" => 'جمادى الأول',
        "6" => 'جمادى الآخرة',
        "7" => 'رجب',
        "8" => 'شعبان',
        "9" => 'رمضان',
        "10" => 'شوال',
        "11" => 'ذو القعدة',
        "12" => 'ذو الحجة'
    ];

    function __construct()
    {

    }

    /**
     * @param $name
     * @return string
     */
    private static function hasError($name)
    {
        if (session()->has('errors')) {
            if (session()->get('errors')->has($name)) {
                return 'has-error';
            }
        }
    }

    /**
     * @param $name
     * @return string
     */
    private static function getError($name)
    {
        if (session()->has('errors')) {
            $error = session()->get('errors')->first($name);
            return '<span class="help-block"><strong>' . $error . '</strong></span>';
        }
    }


    public static function CheckBox2($name, $model , $check = '')
    {
        return ' 
            <div class="form-group col-lg-4" id="' . $name . '_wrap">
                
                <div class="">
                     <input type="checkbox" name="' . $name . '[]" value="' . $model->id . '" '.$check.'>
                     
                    <label for="' . $name . '">' . $model->display_name . '</label>
                </div>
            </div>
        ';


    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @return string
     */
    public static function text($name, $label, $value = null)
    {
        return view('form-fields.text',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @return string
     */
    public static function dateTime($name, $label, $value = null)
    {
        return view('form-fields.date-time',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function number($name, $label,$value=null)
    {
        return view('form-fields.number',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @return string
     */
    public static function email($name, $label,$value = null)
    {
        return view('form-fields.email',compact('name','label','value'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function password($name, $label)
    {
        return view('form-fields.password',compact('name','label'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $plugin
     * @param $max
     * @param $min
     * @param $value
     * @return string
     */
    public static function datePicker($name, $label, $value = null , $max = null , $min = null , $plugin = 'datepicker')
    {
        return view('form-fields.datepicker',compact('name','label','value','plugin','max','min'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param $plugin
     * @return string
     */
    public static function date($name, $label, $value = null , $max = null , $min = null)
    {
        return view('form-fields.date',compact('name','label','value','max','min'))->render();
    }

    public static function dateGeorgian($name, $label, $plugin = 'datepicker')
    {
        return ' 
			<div class="form-group ' . static::hasError($name) . '" id="' . $name . '_wrap">
		        <label for="' . $name . '">' . $label . '</label>
		        <div class="row">
                    <div class="col-xs-1">
                         ' . Form::select($name . '-day', array_combine(range(1, 31), range(1, 31)), null, [
            "class" => "form-control",
            "id" => $name . '-day',
            "placeholder" => "اليوم",
            "onchange" => "collectDate($name)"
        ]) . '
                    </div>
                    <div class="col-xs-2" style="padding-left: 1px;padding-right: 1px;">
                         ' . Form::select($name . '-month', self::$months, null, [
            "class" => "form-control",
            "id" => $name . '-month',
            "placeholder" => "الشهر",
            "onchange" => "collectDate($name)"
        ]) . '
                    </div>
                    <div class="col-xs-2">
                         ' . Form::select($name . '-year', array_combine(range(Carbon::now()->addYears(10)->format('Y'), Carbon::now()->subYears(50)->format('Y'), -1), range(Carbon::now()->addYears(10)->format('Y'), Carbon::now()->subYears(50)->format('Y'), -1)), null, [
            "class" => "form-control ",
            "id" => $name . '-year',
            "placeholder" => "السنة",
            "onchange" => "collectDate($name)"
        ]) . '
                    </div>
                    ' . Form::hidden($name, null, ["id" => $name]) . '
		        </div>
		        ' . static::getError($name) . '
		    </div>
		    <script>window.flyNasDate.push(' . $name . '.id)</script>
		';
    }

    public static function dateHijri($name, $label, $plugin = 'datepicker')
    {
        return ' 
			<div class="form-group ' . static::hasError($name) . '" id="' . $name . '_wrap">
		        <label for="' . $name . '">' . $label . '</label>
		        <div class="row">
                    <div class="col-xs-1">
                         ' . Form::select($name . '-day', array_combine(range(1, 31), range(1, 31)), null, [
            "class" => "form-control",
            "id" => $name . '-day',
            "placeholder" => "اليوم",
            "onchange" => "collectDate($name)"
        ]) . '
                    </div>
                    <div class="col-xs-2" style="padding-left: 1px;padding-right: 1px;">
                         ' . Form::select($name . '-month', self::$hijriMonths, null, [
            "class" => "form-control",
            "id" => $name . '-month',
            "placeholder" => "الشهر",
            "onchange" => "collectDate($name)"
        ]) . '
                    </div>
                    <div class="col-xs-2">
                         ' . Form::select($name . '-year', array_combine(range(1445, 1400, -1), range(1445, 1400, -1)), null, [
            "class" => "form-control ",
            "id" => $name . '-year',
            "placeholder" => "السنة",
            "onchange" => "collectDate($name)"
        ]) . '
                    </div>
                    ' . Form::hidden($name, null, ["id" => $name]) . '
		        </div>
		        ' . static::getError($name) . '
		    </div>
		    <script>window.flyNasDate.push(' . $name . '.id)</script>
		';
    }

    public static function dateHijriOld($name, $label, $plugin = 'datepicker2')
    {
        return ' 
			<div class="form-group ' . static::hasError($name) . '" id="' . $name . '_wrap">
		        <label for="' . $name . '">' . $label . '</label>
		        <div class="">
		             ' . Form::text($name, null, [
            "class" => "form-control " . $plugin,
            "id" => $name
        ]) . '
		        </div>
		        ' . static::getError($name) . '
		    </div>
		';
    }


    /**
     * @param $name
     * @param $label
     * @param $options
     * @param string $plugin
     * @param string $placeholder
     * @param null $selected
     * @return string
     */
    public static function select($name, $label, $options, $selected = null , $plugin = 'select2', $placeholder = 'اختر قيمة')
    {
        return view('form-fields.select',compact('name','label', 'options' ,'selected','plugin','placeholder'))->render();
    }
    
    
    /**
     * @param $name
     * @param $label
     * @param $options
     * @param string $plugin
     * @param string $placeholder
     * @param null $selected
     * @return string
     */
    public static function multiFileUpload($name , $label , $plugin = "file_upload_preview")
    {
        return view('form-fields.multiFile-upload',compact('name','label','plugin'))->render();
    }

    /**
     * @param $name # form control name atrr
     * @param $label # form control label name
     * @param $options # [array] of options
     * @param null $selected # [array] of selected options
     * @param string $plugin # class used for plugin
     * @param string $placeholder # text of placeholder
     * @return string # form-group div bootstrap ready
     */
    public static function multiSelect($name, $label, $options, $selected = null, $plugin = 'select2', $placeholder = '  اختر  ')
    {

        return view('form-fields.multi-select',compact('name','label','options','selected','plugin','placeholder'))->render();
        return '  
			<div class="form-group ' . static::hasError($name) . '" id="' . $name . '_wrap">
		        <label for="' . $name . '">' . $label . '</label>                              
		        <div class="">
		             ' . Form::select($name . '[]', $options, $selected, [
            "class" => "form-control " . $plugin,
            "id" => $name,
            "multiple" => "multiple",
            "data-placeholder" => ' '.$placeholder.' '
        ]) . '
		        </div>
		        ' . static::getError($name) . '
		    </div>
		';
    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function textarea($name, $label , $value = null)
    {
        return view('form-fields.textarea',compact('name','label','value'))->render();
    }

    /**
     * @param $id
     * @param bool $address
     * @param bool $coordinates
     * @param string $height
     * @return string
     */
    public static function gMap($id, $address = true, $coordinates = true, $height = '350')
    {
        $field = new static;

        $addressField = '';
        if ($address) {
            $addressField = $field->text('address', 'العنوان');
        }

        $coordinatesFields = '';
        if ($coordinates) {
            $coordinatesFields = '
				<div class="row">
					<div class="col-xs-6">
						' . $field->text('lat', 'خط الطول') . '
					</div>
					<div class="col-xs-6">
						' . $field->text('long', 'خط العرض') . '
					</div>
				</div>
			';
        }

        return '<div id="' . $id . '">' . $addressField . '<div id="mapField" style="width: 100%; height: ' . $height . 'px;"></div>' . $coordinatesFields . '</div>';

    }

    /**
     * @param $name
     * @param $label
     * @param bool $multiFile
     * @return string
     * @throws \Throwable
     */
    public static function fileWithPreview($name, $label , $multiFile = false)
    {

        return view('form-fields.file',compact('name','label' ,'multiFile'))->render();
        
    }

    public static function checkBox($name, $label ,$options , $value = null)
    {
        return view('form-fields.check-box',compact('name','label','options'))->render();
    }
    /**
     * @param $name
     * @param $label
     * @param $check -> checked
     */
    public static function radio($name, $label ,$options , $checked = null)
    {
        return view('form-fields.radio',compact('name','label','options','checked'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function tagsInput($name, $label)
    {
        return ' 
			<div class="form-group ' . static::hasError($name) . '">
		        <label for="' . $name . '">' . $label . '</label>
		        <div class="">
		             ' . Form::text($name, null, [
            "class" => "form-control tagsinput",
            "id" => $name,
            "data-role" => "tagsinput",
            "onchange" => "return false"
        ]) . '
		        </div>
		        ' . static::getError($name) . '
		    </div>
		';
    }
}