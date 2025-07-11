<?php

namespace app\modules\admin\controllers;

use app\models\db\Page;
use app\models\search\PageSearch;


class PageController extends AbstractAdminController
{
    protected $model = Page::class;
    protected $searchModel = PageSearch::class;
}
