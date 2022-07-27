<?php

namespace app\modules\admin\controllers;

use app\models\Language;
use app\models\LanguageSearch;


class LanguageController extends AbstractAdminController
{
    protected $model = Language::class;
    protected $searchModel = LanguageSearch::class;
}
