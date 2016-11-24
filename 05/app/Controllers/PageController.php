<?php
namespace App\Controllers;

use App\Controller;
use App\View;

class PageController extends Controller
{
    public function actionIndex()
    {
        View::show('page/index');
    }
}
