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
Admin::js('/Trumbowyg/dist/trumbowyg.js');
Admin::js('/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js');
Admin::css('/Trumbowyg/dist/ui/trumbowyg.min.css');
Admin::css('/vendor/laravel-admin/datatables/dataTables.bootstrap.min.css');
Admin::js('/vendor/laravel-admin/datatables/jquery.dataTables.min.js');
Admin::js('/vendor/laravel-admin/datatables/dataTables.bootstrap.min.js');


