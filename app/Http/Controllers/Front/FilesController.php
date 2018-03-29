<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 28/03/2018
 * Time: 2:08 PM
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontBaseController;
use App\Http\Service\NewsService;
use App\Models\SpecialNews;

class FilesController extends FrontBaseController{
    protected $newsService;

    public function __construct(NewsService $newsService){
        parent::__construct();
        $this->newsService = $newsService;
    }

}