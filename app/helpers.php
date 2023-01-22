<?php

if(!function_exists('flash_message_template')){
    function flash_message_template($message_title , $type)
    {
        return [
            'value' => trans('invoices/lang.' . $message_title), 
            'alter_type' => $type
        ];
    }
}