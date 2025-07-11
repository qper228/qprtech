<?php

namespace app\modules\admin\controllers;

use app\models\db\Theme;
use app\models\search\ThemeSearch;


class ThemeController extends AbstractAdminController
{
    protected $model = Theme::class;
    protected $searchModel = ThemeSearch::class;
}
