<?php

if (!function_exists('pharmacy_id')) {
    function pharmacy_id()
    {
        return app()->get('pharmacy_id');
    }
}