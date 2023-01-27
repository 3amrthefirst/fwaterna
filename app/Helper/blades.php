<?php

use Helper\Translation;

Blade::directive('trans', function ($string , $trans_file = 'site') {
    return (new  Translation($trans_file))->trans($string);
});