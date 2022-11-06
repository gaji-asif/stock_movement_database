<?php
if(!function_exists('currentSelectedItem')){
    function currentSelectedItem($value, $old_value)
    {
        return $value == $old_value ? 'selected' : '';
    }
}



