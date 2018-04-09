<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 3:43 PM
 */
namespace App\Http\Controllers;

use App\Http\Service\AlertService;
use App\Http\Service\UserService;
use Illuminate\Support\Facades\View;

class FrontBaseController extends Controller{
    public $module;
    protected $alertService;
    protected $userService;

    public function __construct()
    {
        View::share('active', [$this->module => 'active']);
        $this->alertService = new AlertService();
        $this->userService = new UserService();
    }
}