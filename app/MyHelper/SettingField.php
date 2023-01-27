<?php

namespace App\MyHelper;

use Form;

/**
 * to create dynamic fields for modules
 */
class SettingField
{

    function __construct()
    {
    }

    public static function setInput($model)
    {
        $type = $model->data_type;
        $value = $model->value;

        if ($type == 'fileWithPreview') {

//            $value = $model->photo;
            $value = false;

        } elseif ($type == 'mulifileWithPreview') {

//            $type = 'multiFileUpload';
//            $value = $model->photos;
            $value = true;

        }

        return Field::$type($model->key , $model->display_name , $value);

    }

    public static function validationError($errors, $name)
    {
        if ($errors->any()) {
            $error = $errors->toArray();
            if (array_key_exists($name, $error)) {
                return implode('', $error[$name]);
            }
        }
        return null;

    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function text($name, $label, $error = null, $old_value = null, $old = null)
    {
        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::text($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name
                ]) . '
                </div>

            </div>
        ';
        } else {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::text($name, $old_value, [
                    "class" => "form-control",
                    "style" => "border : 1px solid red",
                    "id" => $name
                ]) . '
                </div>

                <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>
        ';
        }

    }

    public static function number($name, $label, $error = null, $old_value = null, $step = 0.01)
    {
        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::number($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name,
                    "step" => $step
                ]) . '
                </div>
            </div>
        ';
        } else {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::number($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name,
                    "step" => $step
                ]) . '
                </div>
                   <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>
        ';


        }

    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function email($name, $label, $error = null, $old_value = null)
    {
        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::email($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name
                ]) . '
                </div>
            </div>
        ';
        } else {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::email($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name
                ]) . '
                </div>
                     <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>

        ';

        }


    }


    /**
     * @param $name
     * @param $label
     * @param $plugin
     * @return string
     */
    public static function date($name, $label, $error = null, $old_value = null, $plugin = 'datepicker')
    {
        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::text($name, $old_value, [
                    "class" => "form-control " . $plugin,
                    "id" => $name
                ]) . '
                </div>
            </div>
        ';
        } else {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::text($name, $old_value, [
                    "class" => "form-control " . $plugin,
                    "id" => $name
                ]) . '
                </div>
                <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>
        ';

        }

    }

    /**
     * @param $name
     * @param $label
     * @return string
     */
    public static function textarea($name, $label, $error = null, $old_value = null)
    {
        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::textarea($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name,
                    "rows" => 5
                ]) . '
                </div>
            </div>
        ';
        } else {
            return '
            <div class="form-group" id="' . $name . '_wrap">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::textarea($name, $old_value, [
                    "class" => "form-control",
                    "id" => $name,
                    "rows" => 5
                ]) . '
                </div>
                   <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>
        ';

        }

    }


    /**
     * @param $name
     * @param $label
     * @param string $plugin
     * @return string
     */
    public static function fileWithPreview($name, $label, $error = null, $old_value = null, $plugin = "file_upload_preview")
    {
        $old_photos = $old_value ? '<img src="' . url($old_value->name) . '" alt="" class="img-responsive thumbnail">' : '';
        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::file($name, [
                    "class" => "form-control " . $plugin,
                    "id" => $name,
                    "data-preview-file-type" => "text"
                ]) . '
                </div>
            </div>
            <div class="col-md-4">
                    ' . $old_photos . '
                </div>
                <div class="clearfix"></div>
        ';
        } else {
            return '
            <div class="form-group">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::file($name, [
                    "class" => "form-control " . $plugin,
                    "id" => $name,
                    "data-preview-file-type" => "text"
                ]) . '
                </div>
                 <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>
              <div class="col-md-4">
                   ' . $old_photos . '
                </div>
                <div class="clearfix"></div>
        ';
        }


    }


    public static function multiFileWithPreview($name, $label, $error = null, $old_value = null, $plugin = "file_upload_preview")
    {
        $old_photos = '';
        if ($old_value != null) {
            $iteration = 1;
            foreach ($old_value as $photo) {
                $old_photos .= '<div class="col-md-3" id="removable' . $photo->id . '">
                <div class="text-center"
                     style="width: 100%;color: white;background-color: black;font-size: 3rem;font-weight: bolder;">
                    ' . $iteration . '
                </div>
                <img src="' . asset($photo->name) . '" class="img-responsive" alt="">
                <div class="clearfix"></div>
                <button id="' . $photo->id . '" data-token="' . csrf_token() . '"
                        data-route="' . \URL::route('photo.destroy', $photo->id) . '"
                        type="button" class="destroy btn btn-danger btn-xs btn-block">
                    <i class="fa fa-trash"></i>
                </button>
                </div>
                ';

                $iteration++;
            }
            $old_photos .= '<div class="clearfix"></div><br>';
        }


        if (self::validationError($error, $name) == null) {
            return '
            <div class="form-group">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::file($name . '[]', [
                    "class" => "form-control " . $plugin,
                    "id" => $name,
                    "multiple" => "multiple",
                    "data-preview-file-type" => "text"
                ]) . '
                </div>
            </div>
                <div class="clearfix"></div>
                 ' . $old_photos . '
        ';
        } else {
            return '
            <div class="form-group">
                <label for="' . $name . '">' . $label . '</label>
                <div class="">
                     ' . Form::file($name . '[]', [
                    "class" => "form-control " . $plugin,
                    "id" => $name,
                    "multiple" => "multiple",
                    "data-preview-file-type" => "text"
                ]) . '
                </div>
                 <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
            </div>
                <div class="clearfix"></div>
                ' . $old_photos . '
        ';
        }


    }

    /**
     * summernote editor
     *
     *
     */
    public static function editor($name, $label, $error = null, $old_value = null, $plugin = 'summernote')
    {

        if (self::validationError($error, $name) == null) {

            return '<div class="form-group"><label for="' . $name . '">' . $label . '</label>
                  <div class=""> ' . Form::textarea($name, $old_value, [
                    "class" => "form-control " . $plugin,
                    "id" => $name,
                    "rows" => 10
                ]) . ' </div></div>';
        } else {

            return '<div class="form-group"><label for="' . $name . '">' . $label . '</label>
                  <div class=""> ' . Form::textarea($name, $old_value, [
                    "class" => "form-control " . $plugin,
                    "id" => $name,
                    "rows" => 10
                ]) . ' </div>
                   <label id=' . $name . ' class="error_sms">
                <i class="fa fa-exclamation-circle" style="padding-left: 4px"></i>
                ' . self::validationError($error, $name) . '
                </label>
                  </div>';

        }


    }


    public static function validation($models)
    {
        $rules = [];

        foreach ($models as $model) {
            if($model->validation)
            {
                if ($model->data_type == 'mulifileWithPreview') {

                    $rules += [$model->key . ".*" => $model->validation->value];
                } else {
                    $rules += [$model->key => $model->validation->value];
                }
            }
        }

        return $rules;
    }
}
