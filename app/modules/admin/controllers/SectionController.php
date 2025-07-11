<?php

namespace app\modules\admin\controllers;

use app\models\db\Section;
use app\models\search\SectionSearch;


class SectionController extends AbstractAdminController
{
    protected $model = Section::class;
    protected $searchModel = SectionSearch::class;
}
