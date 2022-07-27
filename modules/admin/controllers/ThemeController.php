<?php

namespace app\modules\admin\controllers;

use app\models\Theme;
use app\models\ThemeSearch;
use yii\web\UploadedFile;


class ThemeController extends AbstractAdminController
{
    protected $model = Theme::class;
    protected $searchModel = ThemeSearch::class;
}
