<?php

use App\Models\Settings;

if (!function_exists('profile')) {
    function profile()
    {
        $results = Settings::first();
        return $results;
    }
}