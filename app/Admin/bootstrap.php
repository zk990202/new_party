<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Facades\Admin;

Encore\Admin\Form::forget(['map', 'editor']);
Admin::js('/vendor/laravel-admin/csrf.js');

Admin::css('/vendor/laravel-admin/morris.js/morris.css');
Admin::js('/vendor/laravel-admin/raphael/raphael.min.js');
Admin::js('/vendor/laravel-admin/morris.js/morris.min.js');



