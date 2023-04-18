<?php

declare(strict_types=1);

if (!function_exists('previous_route_name')) {
    function previous_route_name($url)
    {
        return app('router')
            ->getRoutes($url)
            ->match(app('request')->create($url))
            ->getName() ?? 'index';
    }
}

if (!function_exists('app_demo')) {
    function app_demo()
    {
        return config('app.demo');
    }
}


if (!function_exists('setting')) {
    /**
     * Helper function for Setting facade.
     *
     * @param string $key
     * @param mixed $default
     * @param string $constraint_value
     * @return mixed
     */
    function setting($key = null, $default = null, $constraint_value = null)
    {
        $instance = app('setting');

        if (!isset($instance)) {
            $instance = app()->make('App\Support\Setting');
        }

        if (isset($key)) {
            return $instance->get($key, $default, $constraint_value);
        }

        return app('setting');
    }
}


if (!function_exists('get_init_param_value')) {
    function get_init_param_value($value)
    {
        $rtn = 0;
        if (preg_match('/^(\d+)(.)$/', $value, $matches)) {
            if ($matches[2] == 'M') {
                $rtn = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
            } else if ($matches[2] == 'K') {
                $rtn = $matches[1] * 1024; // nnnK -> nnn KB
            }
        }

        return $rtn;
    }
}

if (!function_exists('get_upload_max_size')) {
    function get_upload_max_size()
    {
        $post_max = get_init_param_value(ini_get('post_max_size'));
        $upload_max_filesize = get_init_param_value(ini_get('upload_max_filesize'));

        return min($post_max, $upload_max_filesize) / 1024 / 1024;
    }
}

if (!function_exists('app_installed')) {
    function app_installed()
    {
        return file_exists(base_path('installed'));
    }
}