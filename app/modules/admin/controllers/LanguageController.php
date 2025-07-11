<?php

namespace app\modules\admin\controllers;

use app\models\db\Language;
use app\models\search\LanguageSearch;


class LanguageController extends AbstractAdminController
{
    protected $model = Language::class;
    protected $searchModel = LanguageSearch::class;
}
