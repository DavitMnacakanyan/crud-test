<?php

if (!function_exists('baseDirPath')) {
    /**
     * @return string
     */
    function baseDirPath(): string
    {
        return config('settings.base_dir_path');
    }
}
