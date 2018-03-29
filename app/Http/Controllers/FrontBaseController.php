<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 3:43 PM
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class FrontBaseController extends Controller{
    public $module;

    public function __construct()
    {
        View::share('active', [$this->module => 'active']);
    }
}