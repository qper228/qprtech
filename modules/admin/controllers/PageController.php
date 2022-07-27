<?php

namespace app\modules\admin\controllers;

use app\models\Page;
use app\models\PageSearch;


class PageController extends AbstractAdminController
{
    protected $model = Page::class;
    protected $searchModel = PageSearch::class;
}
